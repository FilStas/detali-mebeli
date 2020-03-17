(function() {
   tinymce.PluginManager.add('storevilla_pro_mce_button', function( editor, url ) {
      editor.addButton( 'storevilla_pro_mce_button', {
         text: 'Short Codes',
         icon: false,
         type: 'menubutton',
         menu: [
            {
               text: 'Layouts',
               menu: [
                  {
                     text: 'Grid',
                     onclick: function() {
                        editor.windowManager.open( {
                           title: 'Insert no columns to show in a row',
                           id:'column-selector',
                           body: [
                              {
                                 type: 'listbox',
                                 name: 'columns',
                                 label: 'No of Columns',
                                 id :'no-of-columns',
                                 'values': [
                                    {text: '1', value: '1'},
                                    {text: '2', value: '2'},
                                    {text: '3', value: '3'},
                                    {text: '4', value: '4'},
                                    {text: '5', value: '5'},
                                    {text: '6', value: '6'},
                                 ]
                              },
                              {
                                 type: 'listbox',
                                 name: 'first_column',
                                 label: 'First Column Width',
                                 id:'first_column',
                                 'values': [
                                    {text: '1', value: '1'},
                                    {text: '2', value: '2'},
                                    {text: '3', value: '3'},
                                    {text: '4', value: '4'},
                                    {text: '5', value: '5'},
                                    {text: '6', value: '6'},
                                 ]
                              },
                              {
                                 type: 'listbox',
                                 name: 'second_column',
                                 label: 'Second Column Width',
                                 id:'second_column',
                                 'values': [
                                    {text: '1', value: '1'},
                                    {text: '2', value: '2'},
                                    {text: '3', value: '3'},
                                    {text: '4', value: '4'},
                                    {text: '5', value: '5'},
                                    {text: '6', value: '6'},
                                 ]
                              },
                              {
                                 type: 'listbox',
                                 name: 'third_column',
                                 label: 'Third Column Width',
                                 id:'third_column',
                                 'values': [
                                    {text: '1', value: '1'},
                                    {text: '2', value: '2'},
                                    {text: '3', value: '3'},
                                    {text: '4', value: '4'},
                                    {text: '5', value: '5'},
                                    {text: '6', value: '6'},
                                 ]
                              },
                              {
                                 type: 'listbox',
                                 name: 'fourth_column',
                                 label: 'Fourth Column Width',
                                 id:'fourth_column',
                                 'values': [
                                    {text: '1', value: '1'},
                                    {text: '2', value: '2'},
                                    {text: '3', value: '3'},
                                    {text: '4', value: '4'},
                                    {text: '5', value: '5'},
                                    {text: '6', value: '6'},
                                 ]
                              },
                              {
                                 type: 'listbox',
                                 name: 'fifth_column',
                                 label: 'Fifth Column Width',
                                 id:'fifth_column',
                                 'values': [
                                    {text: '1', value: '1'},
                                    {text: '2', value: '2'},
                                    {text: '3', value: '3'},
                                    {text: '4', value: '4'},
                                    {text: '5', value: '5'},
                                    {text: '6', value: '6'},
                                 ]
                              },
                              {
                                 type: 'listbox',
                                 name: 'sixth_column',
                                 label: 'Sixth Column Width',
                                 id:'sixth_column',
                                 'values': [
                                    {text: '1', value: '1'},
                                    {text: '2', value: '2'},
                                    {text: '3', value: '3'},
                                    {text: '4', value: '4'},
                                    {text: '5', value: '5'},
                                    {text: '6', value: '6'},
                                 ]
                              },

                           ],
                           onsubmit: function( e ) {
                              
                                 if(e.data.columns == 1){
                                    editor.insertContent( 
                                   '[sv_column_wrap]<br />'+ 
                                   '[sv_column span="'+e.data.first_column+'"]Put your column 1 text[/sv_column]<br />'+
                                   '[/sv_column_wrap]<br />'
                                    );
                                 }else if(e.data.columns == 2){
                                    if((parseInt(e.data.first_column) + parseInt(e.data.second_column)) < 7 ){
                                    editor.insertContent( 
                                    '[sv_column_wrap]<br />'+ 
                                    '[sv_column span="'+e.data.first_column+'"]Put your column 1 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.second_column+'"]Put your column 2 text[/sv_column]<br />'+
                                    '[/sv_column_wrap]<br />'
                                    );
                                    }else{
                                       alert('Invalid! Sum of columns should exceed 6');
                                 }
                                 }else if(e.data.columns == 3){
                                    if((parseInt(e.data.first_column) + parseInt(e.data.second_column) + parseInt(e.data.third_column)) < 7 ){
                                    editor.insertContent( 
                                    '[sv_column_wrap]<br />'+ 
                                    '[sv_column span="'+e.data.first_column+'"]Put your column 1 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.second_column+'"]Put your column 2 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.third_column+'"]Put your column 3 text[/sv_column]<br />'+
                                    '[/sv_column_wrap]<br />'
                                    );
                                    }else{
                                    alert('Invalid! Sum of columns should exceed 6');
                                 }
                                 }else if(e.data.columns == 4){
                                    if((parseInt(e.data.first_column) + parseInt(e.data.second_column) + parseInt(e.data.third_column) + parseInt(e.data.fourth_column)) < 7 ){
                                     editor.insertContent( 
                                    '[sv_column_wrap]<br />'+ 
                                    '[sv_column span="'+e.data.first_column+'"]Put your column 1 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.second_column+'"]Put your column 2 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.third_column+'"]Put your column 3 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.fourth_column+'"]Put your column 4 text[/sv_column]<br />'+
                                    '[/sv_column_wrap]<br />'
                                    );
                                     }else{
                                    alert('Invalid! Sum of columns should exceed 6');
                                 }
                                 }else if(e.data.columns == 5){
                                    if((parseInt(e.data.first_column) + parseInt(e.data.second_column) + parseInt(e.data.third_column) + parseInt(e.data.fourth_column) + parseInt(e.data.fifth_column)) < 7 ){
                                    editor.insertContent( 
                                    '[sv_column_wrap]<br />'+ 
                                    '[sv_column span="'+e.data.first_column+'"]Put your column 1 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.second_column+'"]Put your column 2 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.third_column+'"]Put your column 3 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.fourth_column+'"]Put your column 4 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.fifth_column+'"]Put your column 5 text[/sv_column]<br />'+
                                    '[/sv_column_wrap]<br />'
                                    );
                                    }else{
                                    alert('Invalid! Sum of columns should exceed 6');
                                 }
                                 }else if(e.data.columns == 6){
                                    if((parseInt(e.data.first_column) + parseInt(e.data.second_column) + parseInt(e.data.third_column) + parseInt(e.data.fourth_column) + parseInt(e.data.fifth_column) + parseInt(e.data.sixth_column)) < 7 ){
                                    editor.insertContent( 
                                    '[sv_column_wrap]<br />'+ 
                                    '[sv_column span="'+e.data.first_column+'"]Put your column 1 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.second_column+'"]Put your column 2 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.third_column+'"]Put your column 3 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.fourth_column+'"]Put your column 4 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.fifth_column+'"]Put your column 5 text[/sv_column]<br />'+
                                    '[sv_column span="'+e.data.sixth_column+'"]Put your column 6 text[/sv_column]<br />'+
                                    '[/sv_column_wrap]<br />'
                                    );
                                    }else{
                                       alert('Invalid! Sum of columns should exceed 6');
                                 }
                                 }
                           }
                        });
                     }
                  },
                  {
                     text: 'Divider',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Divider Settings',
                     body: [
                           {
                              type: 'textbox',
                              name: 'border_color',
                              label: 'Border Color',
                              value: '#CCCCCC'
                           },
                           {
                              type: 'listbox',
                              name: 'border_style',
                              label: 'Border Style',
                              'values': [
                                 {text: 'Solid', value: 'solid'},
                                 {text: 'Dashed', value: 'dashed'},
                                 {text: 'Dotted', value: 'dotted'},
                                 {text: 'Double', value: 'double'}
                              ]
                           },
                           {
                              type: 'textbox',
                              name: 'thickness',
                              label: 'Border Thickness',
                              value: '1px'
                           },
                           {
                              type: 'textbox',
                              name: 'border_width',
                              label: 'Border Width',
                              value: '100%'
                           },
                           {
                              type: 'textbox',
                              name: 'mar_top',
                              label: 'Top Spacing',
                              value: '20px'
                           },
                           {
                              type: 'textbox',
                              name: 'mar_bot',
                              label: 'Bottom Spacing',
                              value: '20px'
                           },
                      
                        ],
                        onsubmit: function( e ) {
                           editor.insertContent('[sv_divider color="'+e.data.border_color+'" style="'+e.data.border_style+'" thickness="'+e.data.thickness+'" width="'+e.data.border_width+'" mar_top="'+e.data.mar_top+'" mar_bot="'+e.data.mar_bot+'"]');
                        }
                       });
                     }
                  },
                  {
                     text: 'Spacing',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Spacing Settings',
                     body: [
                           {
                              type: 'textbox',
                              name: 'spacing_height',
                              label: 'Spacing Height',
                              value: '10px'
                           }
                        ],
                        onsubmit: function( e ) {
                           editor.insertContent('[sv_spacing spacing_height="'+e.data.spacing_height+'"]');
                        }
                       });
                     }
                  }
               ]
            },
            {
               text: 'Elements',
               menu: [
                  {
                     text: 'Testimonial',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Testimonial Block',
                     body: [
                           {
                              type: 'textbox',
                              name: 'client_name',
                              label: 'Client Name',
                              value: ''
                           },
                           {
                              type: 'textbox',
                              name: 'client_designation',
                              label: 'Client Designation',
                              value: ''
                           },
                           {
                               type: 'button', 
                               name: 'image_url', 
                               label: 'Testimonial Image',
                               text: 'Select image',
                               icon: 'icon dashicons-format-gallery',
                                onclick: function() {
                                        StorevillaModal();
                               },
                           },                           
                           {
                              type: 'textbox',
                              name: 'testimonial_desc',
                              label: 'Testimonial',
                              value: 'Write the Clients Testimonial Here',
                              multiline: true,
                              minWidth: 300,
                              minHeight: 150
                           },
                              
                        ],
                        onsubmit: function( e ) {
                             editor.insertContent('[sv_testimonial image="'+sv_selected_image+'" image_shape="'+e.data.testimonial_image_shape+'" client="'+e.data.client_name+'" designation="'+e.data.client_designation+'"]<br />'+e.data.testimonial_desc+'<br />[/sv_testimonial]'); 
                        }
                       });
                     }
                  },
                  {
                     text: 'Team',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Team Block',
                     body: [
                           {
                              type: 'textbox',
                              name: 'team_member_name',
                              label: 'Team Member Name',
                              value: ''
                           },
                           {
                              type: 'textbox',
                              name: 'team_member_position',
                              label: 'Team Member Designation',
                              value: ''
                           },
                           {
                               type: 'button', 
                               name: 'team_upload', 
                               label: 'Member Image',
                               text: 'Select image',
                               icon: 'icon dashicons-format-gallery',
                                onclick: function() {
                                        StorevillaModal();
                               },
                           },
                           {
                              type: 'textbox',
                              name: 'team_detail',
                              label: 'Detail',
                              value: 'Write the Team Member Detail Here',
                              multiline: true,
                              minWidth: 300,
                              minHeight: 150
                           },
                              
                        ],
                        onsubmit: function( e ) {
                             editor.insertContent('[sv_team image="'+sv_selected_image+'" name="'+e.data.team_member_name+'" designation="'+e.data.team_member_position+'"]<br />'+e.data.team_detail+'<br />[/sv_team]'); 
                        }
                       });
                     }
                  },
                  {
                     text: 'Social Media Link',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Social Media Block',
                     body: [
                           {
                              type: 'textbox',
                              name: 'facebook',
                              label: 'Facebook Url',
                              value: 'http://facebook.com/',
                              minWidth: 300,
                           },
                           {
                              type: 'textbox',
                              name: 'twitter',
                              label: 'Twitter Url',
                              value: 'http://twitter.com/',
                              minWidth: 300,
                           },
                           {
                              type: 'textbox',
                              name: 'gplus',
                              label: 'Google Plus Url',
                              value: 'https://plus.google.com/',
                              minWidth: 300,
                           },
                           {
                              type: 'textbox',
                              name: 'linkedin',
                              label: 'Linkedin Url',
                              value: 'http://linkedin.com/',
                              minWidth: 300,
                           },
                           {
                              type: 'textbox',
                              name: 'youtube',
                              label: 'Youtube Plus Url',
                              value: 'http://www.linkedin.com/',
                              minWidth: 300,
                           },
                           {
                              type: 'textbox',
                              name: 'dribble',
                              label: 'Dribble Url',
                              value: 'https://dribbble.com/',
                              minWidth: 300,
                           },
                        ],
                        onsubmit: function( e ) {
                           editor.insertContent('[sv_social facebook="'+e.data.facebook+'" twitter="'+e.data.twitter+'" gplus="'+e.data.gplus+'" linkedin="'+e.data.linkedin+'" youtube="'+e.data.youtube+'" dribble="'+e.data.dribble+'"]'); 
                        }
                       });
                     }
                  },
                  {
                     text: 'Toggle',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Toggle',
                     body: [
                           {
                              type: 'textbox',
                              name: 'toggle_heading',
                              label: 'Heading',
                              value: 'Your Heading',
                              minWidth: 400,
                           },
                           {
                              type: 'textbox',
                              name: 'toggle_detail',
                              label: 'Detail',
                              value: 'Write Detail Here',
                              multiline: true,
                              minWidth: 400,
                              minHeight: 150
                           },
                           {
                              type: 'listbox',
                              name: 'open_close',
                              label: 'Open/Close',
                              'values': [
                                 {text: 'Close', value: 'close'},
                                 {text: 'Open', value: 'open'}
                              ]
                           },
                        ],
                        onsubmit: function( e ) {
                             editor.insertContent('[sv_toggle title="'+e.data.toggle_heading+'" status="'+e.data.open_close+'"]'+e.data.toggle_detail+'[/sv_toggle]'); 
                        }
                       });
                     }
                  },
                  {
                     text: 'Call to Action',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Call to Action Setting',
                     body: [
                           {
                              type: 'textbox',
                              name: 'call_to_action',
                              label: 'Call to Action Text',
                              value: 'Call to action text',
                              multiline: true,
                              minWidth: 500,
                              minHeight: 150
                           },
                           {
                              type: 'textbox',
                              name: 'call_to_action_btn',
                              label: 'Button Text',
                              value: 'Read More',
                              minWidth: 500,
                           },
                           {
                              type: 'textbox',
                              name: 'call_to_action_btn_url',
                              label: 'Button Url',
                              value: '#',
                              minWidth: 500,
                           },
                           {
                              type: 'listbox',
                              name: 'btn_align',
                              label: 'Button Align',
                              'values': [
                                 {text: 'Center', value: 'center'},
                                 {text: 'Right', value: 'right'}
                              ]
                           },
                        ],
                        onsubmit: function( e ) {
                             editor.insertContent('[sv_call_to_action button_text="'+e.data.call_to_action_btn+'" button_url="'+e.data.call_to_action_btn_url+'" button_align="'+e.data.btn_align+'"]'+e.data.call_to_action+'[/sv_call_to_action]'); 
                        }
                       });
                     }
                  },
                  {
                     text: 'Tagline Box',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Tagline Box Setting',
                     body: [
                           {
                              type: 'textbox',
                              name: 'sv_tagline_text',
                              label: 'Tagline Text',
                              value: 'Enter you Tag Line text here',
                              multiline: true,
                              minWidth: 500,
                              minHeight: 150
                           },
                           {
                              type: 'listbox',
                              name: 'tag_box_style',
                              label: 'Tag Box Style',
                              'values': [
                                 {text: 'Border Box', value: 'sv-all-border-box'},
                                 {text: 'Top Border Box', value: 'sv-top-border-box'},
                                 {text: 'Left Border Box', value: 'sv-left-border-box'},
                                 {text: 'Theme Background Box', value: 'sv-bg-box'}
                              ]
                           }
                        ],
                        onsubmit: function( e ) {
                             editor.insertContent('[sv_tagline_box tag_box_style="'+e.data.tag_box_style+'"]'+e.data.sv_tagline_text+'[/sv_tagline_box]'); 
                        }
                       });
                     }
                  },
                  {
                     text: 'Slider',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Slider Settings',
                     body: [
                           {
                              type: 'textbox',
                              name: 'no_of_img',
                              label: 'No of Image',
                              value: '4',
                              minWidth: 500,
                           },
                           {
                              type: 'listbox',
                              name: 'show_caption',
                              label: 'Show Caption',
                              'values': [
                                 {text: 'Yes', value: 'yes'},
                                 {text: 'No', value: 'no'}
                              ]
                           },
                           {
                              type: 'listbox',
                              name: 'link_image',
                              label: 'Link Image to Url',
                              'values': [
                                 {text: 'Yes', value: 'yes'},
                                 {text: 'No', value: 'no'}
                              ]
                           },
                           {
                              type: 'listbox',
                              name: 'open_link',
                              label: 'Open Link',
                              'values': [
                                 {text: 'In Same Tab', value: 'self'},
                                 {text: 'In Different Tab', value: 'blank'}
                              ]
                           },
                        ],
                        onsubmit: function( e ) {
                           var caption, link_image, open_link, j;
                           
                           editor.insertContent('[sv_slider]');
                           for(i=1; i <= e.data.no_of_img; i++){
                              caption = e.data.show_caption=="yes" ? 'caption="Caption text'+i+'"' : '';
                              link_image = e.data.link_image=="yes" ? 'link="http://linkto'+i+'"' : '';
                              open_link = e.data.open_link=="self" ? 'target="_self"' : 'target="_blank"';

                              editor.insertContent(
                              '<br />[sv_slide '+caption+' '+link_image+' '+open_link+']http://your_image_url'+i+'[/sv_slide]'
                              ); 
                             }
                           editor.insertContent('<br />[/sv_slider]');
                        }
                       });
                     }
                  },
                  {
                     text: 'Tab',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Tab Settings',
                     body: [
                           {
                              type: 'textbox',
                              name: 'no_of_tab',
                              label: 'No of Tabs',
                              value: '4',
                              minWidth: 300,
                           },
                           {
                              type: 'listbox',
                              name: 'tab_type',
                              label: 'Show Caption',
                              'values': [
                                 {text: 'Horizontal', value: 'horizontal'},
                                 {text: 'Vertical', value: 'vertical'}
                              ]
                           },
                        ],
                        onsubmit: function( e ) {
                           var j;
                           
                           editor.insertContent('[sv_tab_group type="'+e.data.tab_type+'"]');
                           for(j=1; j <= e.data.no_of_tab; j++){
                              editor.insertContent(
                              '<br />[sv_tab title="Title '+j+'"]Content '+j+'[/sv_tab]'
                              ); 
                             }
                           editor.insertContent('<br />[/sv_tab_group]');
                        }
                       });
                     }
                  },
                  {
                     text: 'List Style',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Select List style',
                     body: [
                           {
                              type: 'textbox',
                              name: 'no_of_list',
                              label: 'No of List Items',
                              value: '4',
                              minWidth: 300,
                           },
                           {
                              type: 'listbox',
                              name: 'list_type',
                              label: 'List Icon',
                              'values': [
                                 {text: 'Thunder Icon', value: 'sv-list1'},
                                 {text: 'Pin Icon', value: 'sv-list2'},
                                 {text: 'Tick Icon', value: 'sv-list3'},
                                 {text: 'Star Icon', value: 'sv-list4'},
                                 {text: 'Money Bag Icon', value: 'sv-list5'},
                                 {text: 'Square Icon', value: 'sv-list6'}
                              ]
                           },
                        ],
                        onsubmit: function( e ) {
                           var k;
                           
                           editor.insertContent('[sv_list list_type="'+e.data.list_type+'"]');
                           for(k=1; k <= e.data.no_of_list; k++){
                              editor.insertContent(
                              '<br />[sv_li]List Item '+k+'[/sv_li]'
                              ); 
                             }
                           editor.insertContent('<br />[/sv_list]');
                        }
                       });
                     }
                  },
                  {
                     text: 'Button',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Button Setting',
                     body: [
                           {
                              type: 'textbox',
                              name: 'button_url',
                              label: 'Buttom Url',
                              value: 'http://',
                              minWidth: 300,
                           },
                           {
                              type: 'textbox',
                              name: 'button_text',
                              label: 'Buttom Text',
                              value: 'Read More',
                              minWidth: 300,
                           },
                           {
                              type: 'listbox',
                              name: 'button_size',
                              label: 'Button Size',
                              'values': [
                                 {text: 'Small', value: 'sv-small-bttn'},
                                 {text: 'Medium', value: 'sv-medium-bttn'},
                                 {text: 'Large', value: 'sv-large-bttn'}
                              ]
                           },
                           {
                              type: 'listbox',
                              name: 'button_type',
                              label: 'Button Type',
                              'values': [
                                 {text: 'Outline Button', value: 'sv-outline-bttn'},
                                 {text: 'Background Button', value: 'sv-bg-bttn'}
                              ]
                           },
                           {
                              type: 'listbox',
                              name: 'button_color',
                              label: 'Button Color',
                              'values': [
                                 {text: 'Default Theme Color', value: 'sv-default-bttn'},
                                 {text: 'Black', value: 'sv-black-bttn'},
                                 {text: 'White', value: 'sv-white-bttn'}
                              ]
                           },
                           {
                              type: 'listbox',
                              name: 'button_align',
                              label: 'Button Align',
                              'values': [
                                 {text: 'None', value: 'sv-align-none'},
                                 {text: 'Left', value: 'sv-align-left'},
                                 {text: 'Right', value: 'sv-align-right'}
                              ]
                           },
                        ],
                        onsubmit: function( e ) {
                           editor.insertContent('[sv_button button_size="'+e.data.button_size+'" button_url="'+e.data.button_url+'" button_type="'+e.data.button_type+'" button_color="'+e.data.button_color+'" button_align="'+e.data.button_align+'"]'+e.data.button_text+'[/sv_button]'); 
                        }
                       });
                     }
                  },
                  {
                     text: 'Drop Caps',
                     onclick: function() {
                     editor.windowManager.open( {
                     title: 'Drop Caps Setting',
                     body: [
                           {
                              type: 'textbox',
                              name: 'letter',
                              label: 'Letter',
                              value: '',
                              minWidth: 300,
                           },
                           {
                              type: 'listbox',
                              name: 'style',
                              label: 'Drop Cap Style',
                              'values': [
                                 {text: 'Normal', value: 'sv-normal'},
                                 {text: 'Square', value: 'sv-square'}
                              ]
                           }
                        ],
                        onsubmit: function( e ) {
                           editor.insertContent('[sv_dropcaps style="'+e.data.style+'"]'+e.data.letter+'[/sv_dropcaps]'); 
                        }
                       });
                     }
                  }
               ]
            }
         ]
      });
   });

function StorevillaModal(){
    // Uploading files
    var file_frame; 
    event.preventDefault(); 
    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.open();
      return;
    } 
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: jQuery( this ).data( 'uploader_title' ),
      button: {
        text: jQuery( this ).data( 'uploader_button_text' ),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });
     // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get('selection').first().toJSON();
      sv_selected_image = attachment.url;
      jQuery('.mce-i-icon.dashicons-format-gallery').parent().addClass('image-bg-button');
      jQuery('.mce-i-icon.dashicons-format-gallery').parent().css('background-image','url('+attachment.url+')');
      // Do something with attachment.id and/or attachment.url here
    }); 
    // Finally, open the modal
    file_frame.open();
}

})();