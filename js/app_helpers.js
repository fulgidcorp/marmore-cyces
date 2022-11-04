"use strict";

/**
 * Gets the passed URL params for a given page and return the query_param value for the
 * passed key. Used while sending data to the server.
 */
function getURLParam(k) {
  var p = {};
  location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (s, k, v) {
    p[k] = v;
  });
  return k ? p[k] : p; // single value or all
}
/**
 * The user input modal handles the data while creating a component and while
 * editing a component. This function is used to get the necessary data from the model.
 * This is moslty called before sending data to the BE.
 */

function getUserInputFromModal() {
  var data_to_send = JSON.parse(JSON.stringify(INITIAL_STATE["add_element_config"]));
  data_to_send["code"] = state.add_element_config["code"];
  data_to_send["id"] = state.add_element_config["id"] || null; // text input

  $.each($("#element_input_form .text_input"), function (index, element) {
    var dict_key_to_store = element.name.indexOf("__") > -1 ? "temp" : "values";
    data_to_send[dict_key_to_store][element.name] = element.value;
  }); // check input

  $.each($("#element_input_form .check_input"), function (index, element) {
    data_to_send["css_config"][element.name] = element.checked;
  }); // other backend config

  data_to_send["page_id"] = getURLParam("view");
  //console.log(data_to_send);return false;
  return data_to_send;
}
/**
 * This function sends the requests to the BE server. This uses ajax jQuery.
 * This is also used to send Form and JSON data depending on the params.
 */

function sendAjaxRequest(data, url, method, isFileUpload, successFunc) {
  var ajax_config = {};

  if (isFileUpload) {
    // for file upload | i.e FormData
    ajax_config = {
      data: data,
      contentType: false,
      processData: false
    };
  } else {
    // for other json request | json data
    ajax_config = {
      data: JSON.stringify(data),
    //   dataType: "json",
       contentType: "application/json"
    };
  } // prepare the ajax configuration to trigger

//   var ajax_config = JSON.parse(JSON.stringify(other_config));
  ajax_config["url"] = url;
  ajax_config["type"] = method;

  ajax_config["beforeSend"] = function (_) {
    // console.log(data);
    // console.log(JSON.stringify(data));
    // return false;
  };

  ajax_config["success"] = function (result) {
    if (successFunc === null) {
      window.location.reload();
    } else {
      successFunc(result);
    }
  };

  ajax_config["error"] = function (jqXHR, textStatus, errorThrown) {
    //   console.log(jqXHR);
    //   console.log(textStatus);
      console.log(errorThrown);
      return false;
     //window.location.reload();
  };

 debugger
  $.ajax(ajax_config);
}
/**
 * This function resets the add_element_config state and the linked model.
 * Used after each opeartion that modifies the model.
 */

function resetAddElementConfig() {
  state["add_element_config"] = INITIAL_STATE["add_element_config"];
  $("#element_input_modal #element_input_form").empty();
}
/**
 * This is called before the opening/init of the model. This simply sets the state
 * for the model based on the element code.
 */

function setAddElementState(element_code) {
  // variable to update the state
  var add_element_config = JSON.parse(
    JSON.stringify(INITIAL_STATE["add_element_config"])
  ); // get the element config

  var input_element_config = getAllElementsConfig()[element_code]; // input values

  $.each(input_element_config["values"], function (index, input_key) {
    add_element_config["values"][input_key] = "";
  }); // select values

  $.each(input_element_config["css_config"], function (css_key, css_class) {
    add_element_config["css_config"][css_key] = false;
  }); // code for the input

  add_element_config["code"] = element_code; // update state before model open

  state["add_element_config"] = add_element_config;
}
/**
 * To init the contents of the modal based on the data from the state.
 * This renders other dynamic fields as well.
 */

function initAddElementConfigModal() {
  var input_data_container = $("#element_input_modal #element_input_form");
  var add_element_config = state["add_element_config"];
  //console.log(add_element_config);
  var text_input = add_element_config["values"];
  var check_input = add_element_config["css_config"]; // text input
  var latest_config = {};
  var config_code = state["add_element_config"]["code"];
  var current_element_config = getAllElementsConfig()[config_code]["values"];
  $.each(current_element_config, function(i){
      let key = current_element_config[i];
      if( key in text_input){
          latest_config[key]= text_input[key];
      }else{
          latest_config[key] = "";
      }
  });


  $.each(latest_config, function (input_name, input_value) {
    var form_group = $("<div></div>").addClass("form-group");
    form_group.append($("<label></label>").text(input_name));
    form_group.append(
      $("<textarea>".concat(input_value, "</textarea>"))
        .addClass("form-control text_input card-text")
        .attr("name", input_name)
    ); // if in case an image uploader is necessary
    // add a button that helps upload and get the file url

    if (input_name.indexOf("image_src") > -1 || input_name.indexOf("file_src") > -1) {
      form_group.append(
        $(
          "<input type=\"file\" class='mt-2' name='".concat(
            input_name,
            "__file' />"
          )
        ).on("change", function () {
          var formData = new FormData();
          var files = $("input[name='".concat(input_name, "__file']"))[0].files;

          if (files.length > 0) {
			formData.append("file", files[0]);
            sendAjaxRequest(
              formData,
              "content.php",
              "POST",
              true,
              function (result) {
                $("textarea[name='".concat(input_name, "']"))[0].value =
                  result["file"];
              }
            );
          }
        })
      );
    }

    input_data_container.append(form_group); // dont convert to ckeditor if its an upload required filed

    if (
        input_name.indexOf("content") > -1
    ) {
      // init CK editor 5 for each text area
      ClassicEditor.create(
        document.querySelector("textarea[name='".concat(input_name, "']")),
        {
					
				toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'outdent',
						'indent',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo',
						'alignment',
						'htmlEmbed'
					]
				},
				language: 'en',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:inline',
						'imageStyle:block',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
					licenseKey: '',
					
					
					
				}
      ).then(function (editor) {
        editor.model.document.on("change:data", function () {
          $(
            "textarea[name='".concat(input_name, "']")
          )[0].value = editor.getData();
        });
      });
    }
  }); // just to separate css from html

  input_data_container.append($("<hr />")); // checkbox input

  $.each(check_input, function (input_name, input_value) {
    var form_group = $("<div></div>").addClass("form-group form-check");
    form_group.append(
      $("<input/>")
        .addClass("form-check-input check_input")
        .attr("name", input_name)
        .attr("type", "checkbox")
        .attr("checked", input_value)
    );
    form_group.append(
      $("<label></label>").text(input_name).addClass("form-check-label")
    );
    input_data_container.append(form_group);
  });
}
/**
 * Given the parent block under which the saved elements are to be created, this function
 * renders the elements using the defined config and other stuff. When the `addModifyActions` is
 * passed, this adds the edit and the delete button as well for modification operations.
 */

function renderSavedElements(jQueryElement) {
  var addModifyActions =
    arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
  // for each element in the data from the server
  $.each(saved_elements_data, function (index, saved_config) {
    var code = saved_config["code"];
    var text_input = saved_config["values"];
    //console.log(code);
    var element_config = getAllElementsConfig()[code];
    //console.log(element_config);
    var current_element_config = element_config["values"];
    var html = "<div>"+element_config["html"]+"</div>"; // adding ID for dynamic content
    var latest_config = {};

    html = html.replace(/{id}/gi, saved_config["id"] || "null"); // replace html values
    //console.log(html);

    
    $.each(current_element_config, function(i){
          let key = current_element_config[i];
          if( key in text_input){
              latest_config[key]= text_input[key];
          }else{
              latest_config[key] = "";
          }
              //console.log(latest_config[key]);

      });
    

    $.each(latest_config, function (data_name, data_value) {
      html = html.replaceAll("{".concat(data_name, "}"), data_value); // other custom elements | showing file source

      if (["file_src"].indexOf(data_name) > -1) {
        html = html.replace(/{file_src_name}/gi, data_value.split("/").pop());
      }
    }); // adding the css class names

    var css_class_string = "";
    $.each(saved_config["css_config"], function (css_key, css_bool) {
      if (css_bool) {
        css_class_string += "".concat(
          element_config["css_config"][css_key],
          " "
        );
      }
    });
    html = html.replace(/{css_classes}/gi, css_class_string);
    
    html = $(html).attr("id", "".concat(code, "_").concat(saved_config["id"]))

    if (addModifyActions) {
      // init the actions
      var action_tab = $('<div class="d-flex justify-content-end my-3"></div>');
      action_tab.append(
        $(
          '<div data-action="sort" data-id="'+saved_config["id"]+'" class="btn btn-secondary mr-2 pointer-move">Move</div>'
        ));
      action_tab.append(
        $(
          '<button type="button" class="btn btn-warning mr-2">Edit</button>'
        ).on("click", function (e) {
          e.preventDefault(); // edit element state

           state["add_element_config"] = saved_config;
           initAddElementConfigModal(); // show modal

          $("#element_input_modal").modal("show");
        })
      );
      action_tab.append(
        $('<button type="button" class="btn btn-danger">Delete</button>').on(
          "click",
          function (e) {
            e.preventDefault();
            sendAjaxRequest(
              {
                page_id: getURLParam("view"),
                id: saved_config["id"],
                data: saved_config["values"],
                code:saved_config["code"]
              },
              "content.php",
              "DELETE",
              false,
              null
            );
          }
        )
      ); // action tab move | edit | delete

      html.prepend(action_tab);
    } // add formed content to container

    jQueryElement.append(
      html
    );
  });
  
  if(addModifyActions){
  
  jQueryElement.sortable(
      { 
          handle: '[data-action="sort"]',
          update: function( event, ui ) {
              update_order();
          }
          
          
      }
    );
    
  } 
  
}


function update_order(){
    let order_data = {}
    $("[data-action=\"sort\"]").each(
        function(index){
            order_data[$(this).attr("data-id")] = index+1;
        }
        );
    //console.log(order_data);
    
    $.ajax('sort.php', {
        method: 'POST',
        data: order_data,
        success: function (response){
            //console.log(response);
        }
    })
}
