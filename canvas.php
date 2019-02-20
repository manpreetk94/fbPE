<input type="checkbox" name="" class="full_screen_canvas">
<label>Add a fullscreen Canvas</label>
    <ul class="canvas_options" >
    <li>
        <div class="r">
            <input type="radio" name="full-scrn-options">
        </div>
        <div class="des">
            Quick creation from a template
            <div class="new-cst-and-use-temp-row">
                <span class="light-grey-btn get-new-customer">Get new customer <i class="fa fa-caret-down"></i></span>
                <div class="three-new-customers-list">
                    <div class="s-r">
                        <div class="s-r-left">
                            <img src="img/new-cus-img.png">
                        </div>
                        <div class="s-r-right">
                            <b>Get New Customers</b>
                            <p>Drive conversions with a mobile landing page that encourages action.</p>
                        </div>
                    </div>
                    <div class="s-r">
                        <div class="s-r-left">
                            <img src="img/new-cus-img.png">
                        </div>
                        <div class="s-r-right">
                            <b>Get New Customers</b>
                            <p>Drive conversions with a mobile landing page that encourages action.</p>
                        </div>
                    </div>
                    <div class="s-r">
                        <div class="s-r-left">
                            <img src="img/new-cus-img.png">
                        </div>
                        <div class="s-r-right">
                            <b>Get New Customers</b>
                            <p>Drive conversions with a mobile landing page that encourages action.</p>
                        </div>
                    </div>
                </div>
                <span type="button" class="blue-btn" data-toggle="modal" data-target="#useTemplate">Use Template</span>

            </div>
        </div>
    </li>
    <li>
        <div class="r">
            <input type="radio" name="full-scrn-options">
        </div>
        <div class="des">
            Create a Canvas using advanced creation
            <div class="create-canv">
                <span class="blue-btn" data-toggle="modal" data-target="#create-canv-popup">Create</span>
                <div id="create-canv-popup" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Canvas Builder</h4>
                            </div>
                            <div class="modal-body">
                                <div class="canvs-popup-header-optns">
                                    <a href="#add-cnvs-component-popup" class="round-cmpnt-btn" data-toggle="modal"><i class="fa fa-plus-circle"></i>Component</a>
                                    <ul>
                                        <li><i class="fa fa-mobile"></i>
                                            <br/>Preview</li>
                                        <li><i class="fa fa-mobile"></i>
                                            <br/>Share</li>
                                        <li><i class="fa fa-save"></i>
                                            <br/>Save</li>
                                        <li><i class="fa fa-check-square"></i>
                                            <br/>Finish</li>
                                    </ul>
                                </div>
                                <div class="canvs-components">
                                    <div class="canvs-components-left-sec">
                                        <div class="canvs-row">
                                            <input type="text" name="" placeholder="Give our canvas a name ..." class="canvs-title-field">
                                        </div>
                                        <div class="canvs-row he-cnvs-row se-cnvs-row">
                                            <div class="panel-group" id="accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                    		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#cnvs-settings">
                                                    			Settings
                                                    		</a>
                                                    	</h4>
                                                    </div>
                                                    <div id="cnvs-settings" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="common-row">
                                                                <div class="col-md-3">
                                                                    <label>Theme</label>
                                                                </div>
                                                                <div class="col-md-9 theme-optn">
                                                                    <div class="tra-bg">
                                                                        <input type="radio" name="theme-optn"><a href="#">T</a></div>
                                                                    <div class="grey-bg">
                                                                        <input type="radio" name="theme-optn"><a href="#">T</a></div>
                                                                    <div class="cust-bg">
                                                                        <input type="radio" name="theme-optn">
                                                                        <button class="jscolor" style="width:50px; height:20px;"></button>Custom</div>
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3">
                                                                    <label>Swipe to open final link <i class="fa fa-info-circle"></i></label>
                                                                </div>
                                                                <div class="col-md-9 theme-optn">
                                                                    <input type="checkbox" class="ad_status" data-toggle="toggle" data-size="mini">
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3">
                                                                    <label>Support Instagram <i class="fa fa-info-circle"></i></label>
                                                                </div>
                                                                <div class="col-md-9 theme-optn">
                                                                    <input type="checkbox" class="ad_status" data-toggle="toggle" data-size="mini">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="canvs-row he-cnvs-row">
                                            <div class="panel-group" id="header-accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                    		<span>Header <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
                                                    		<a class="accordion-toggle" data-toggle="collapse" data-parent="#header-accordion" href="#cnvs-header">
                                                    			&nbsp;
                                                    		</a>
                                                    		<div class="dropdown comp-option-drp">
                                                    			<button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
                                                    			<ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
                                                    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
                                                    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>
                                                    			</ul>
                                                    		</div>
                                                    	</h4>
                                                    </div>
                                                    <div id="cnvs-header" class="panel-collapse collapse">
                                                        <div class="panel-body header-component">
                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <img src="img/dummy-img-thumbnail.jpg">
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    Upload a logo for your Canvas. For best results, images should be 882 x 66 pixels
                                                                    <br/>
                                                                    <button class="light-grey-btn">Upload Photo</button>
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Background Color</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    abc
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Background Opacity</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    <option>
                                                                        <select>Select</select>
                                                                    </option>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="canvs-row cr-cnvs-row">
                                            <div class="panel-group" id="carousel-accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                		<span>Carousel <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
                                                		<a class="accordion-toggle" data-toggle="collapse" data-parent="#carousel-accordion" href="#carousel-header">
                                                			&nbsp;
                                                		</a>
                                                		<div class="dropdown comp-option-drp">
                                                			<button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
                                                			<ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
                                                				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
                                                				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>
                                                			</ul>
                                                		</div>
                                                	</h4>
                                                    </div>
                                                    <div id="carousel-header" class="panel-collapse collapse">
                                                        <div class="panel-body header-component">

                                                            <div class="common-row">
                                                                <p>Upload 2-10 images to show them in a carousel format. If images are not the same size, they will be cropped to match your first image.</p>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Layout</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    <div>
                                                                        <input type="radio" name="layout-opt"><i class="fa fa-mobile"></i>Fit to Width (Linkable)
                                                                    </div>
                                                                    <div>
                                                                        <input type="radio" name="layout-opt"><i class="fa fa-mobile"></i>FFit to Height (Tilt to Pan)
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <ul class="crsl-slide">
                                                                    <li><a href="#">1</a></li>
                                                                    <li><a href="#" class="active">2</a></li>
                                                                    <li><a href="#">+</a></li>
                                                                </ul>
                                                                <div class="edit-selected-slide">
                                                                    <div class="common-row">
                                                                        <div class="left-img">
                                                                            <img src="img/use-temp-img-thumb.jpg">
                                                                        </div>
                                                                        <div class="right-detail">
                                                                            <button class="light-grey-btn">Upload Photo</button>
                                                                            <button class="light-grey-btn pull-right"><i class="fa fa-trash"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="common-row">
                                                                        <label>Destination</label>
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <div class="custom-autocomplete-select cnvs-destination-dropdown">
                                                                                    <select class="selectpicker show-tick" data-size="3">
                                                                                        <option data-tokens="ketchup mustard">Website</option>
                                                                                        <option data-tokens="mustard">App Store</option>
                                                                                        <option data-tokens="frosting">Canvas</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" name="" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="canvs-row btn-cnvs-row">
                                            <div class="panel-group" id="button-accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                    		<span>Button <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
                                                    		<a class="accordion-toggle" data-toggle="collapse" data-parent="#button-accordion" href="#button-header">
                                                    			&nbsp;
                                                    		</a>
                                                    		<div class="dropdown comp-option-drp">
                                                    			<button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
                                                    			<ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
                                                    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
                                                    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li> 
                                                    			</ul>
                                                    		</div>
                                                    	</h4>
                                                    </div>
                                                    <div id="button-header" class="panel-collapse collapse">
                                                        <div class="panel-body header-component">
                                                            <div class="common-row">
                                                                <form>
                                                                    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
                                                                </form>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Destination (required)</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    <div class="col-md-4">
                                                                        <div class="custom-autocomplete-select cnvs-destination-dropdown">
                                                                            <select class="selectpicker show-tick" data-size="3">
                                                                                <option data-tokens="ketchup mustard">Website</option>
                                                                                <option data-tokens="mustard">App Store</option>
                                                                                <option data-tokens="frosting">Canvas</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" placeholder="http://" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Button color</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    d
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Background color</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    d
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Button style</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    <div class="col-md-6">
                                                                        <input type="radio" name="btn-style">Border (default)
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="radio" name="btn-style">Fill
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Button position</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    <div class="col-md-6">
                                                                        <input type="radio" name="btn-pos">In line (default)
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="radio" name="btn-pos">Fixed to Bottom
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="canvs-row photo-cnvs-row">
                                            <div class="panel-group" id="photo-accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                    		<span>Photo <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
                                                    		<a class="accordion-toggle" data-toggle="collapse" data-parent="#photo-accordion" href="#photo-header">
                                                    			&nbsp;
                                                    		</a>
                                                    		<div class="dropdown comp-option-drp">
                                                    			<button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
                                                    			<ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
                                                    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
                                                    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>       
                                                    			</ul>
                                                    		</div>
                                                    	</h4>
                                                    </div>
                                                    <div id="photo-header" class="panel-collapse collapse">
                                                        <div class="panel-body header-component">

                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Layout</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    <div class="col-md-4">
                                                                        <input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Width (Linkable)
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Width (Tap to Expand)
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Height (Tilt to Pan)
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="edit-selected-slide">
                                                                    <div class="common-row">
                                                                        <div class="left-img">
                                                                            <img src="img/use-temp-img-thumb.jpg">
                                                                        </div>
                                                                        <div class="right-detail">
                                                                            <p>Recommended: Image height of 1920 pixels</p>
                                                                            <button class="light-grey-btn">Upload Photo</button>

                                                                        </div>
                                                                    </div>
                                                                    <div class="common-row">
                                                                        <label>Destination</label>
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <div class="custom-autocomplete-select cnvs-destination-dropdown">
                                                                                    <select class="selectpicker show-tick" data-size="3">
                                                                                        <option data-tokens="ketchup mustard">Website</option>
                                                                                        <option data-tokens="mustard">App Store</option>
                                                                                        <option data-tokens="frosting">Canvas</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" name="" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="canvs-row text-cnvs-row">
                                            <div class="panel-group" id="text-accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                    		<span>Text <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
                                                    		<a class="accordion-toggle" data-toggle="collapse" data-parent="#text-accordion" href="#text-header">
                                                    			&nbsp;
                                                    		</a>
                                                    		<div class="dropdown comp-option-drp">
                                                    			<button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
                                                    			<ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
                                                    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
                                                    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>
                                                    			</ul>
                                                    		</div>
                                                    	</h4>
                                                    </div>
                                                    <div id="text-header" class="panel-collapse collapse">
                                                        <div class="panel-body header-component">
                                                            <div class="common-row">
                                                                <p>Add context to your ad. Tell people more about your product or brand.</p>
                                                                <!--   <form> -->
                                                                <textarea name="editor2" id="editor2" rows="10" cols="80"></textarea>
                                                                <!-- </form> -->
                                                            </div>

                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Background color</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    d
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="canvs-row video-cnvs-row">
                                            <div class="panel-group" id="video-accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                    		<span>Video <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
                                                    		<a class="accordion-toggle" data-toggle="collapse" data-parent="#video-accordion" href="#video-header">
                                                    			&nbsp;
                                                    		</a>
                                                    		<div class="dropdown comp-option-drp">
                                                    			<button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
                                                    			<ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
                                                    				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
                                                    			</ul>
                                                    		</div>
                                                    	</h4>
                                                    </div>
                                                    <div id="video-header" class="panel-collapse collapse">
                                                        <div class="panel-body header-component">

                                                            <div class="common-row">
                                                                <div class="col-md-3 left">
                                                                    <label>Layout</label>
                                                                </div>
                                                                <div class="col-md-9 right">
                                                                    <div class="col-md-6">
                                                                        <input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Width
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Height (Tilt to Pan)
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="common-row">
                                                                <div class="edit-selected-slide">
                                                                    <div class="common-row">
                                                                        <div class="left-img">
                                                                            <img src="img/use-temp-img-thumb.jpg">
                                                                        </div>
                                                                        <div class="right-detail">
                                                                            <p>Upload a video file (.mp4 or .mov). Recommended: keep your videos under 2 minutes and use captions so that people can still engage without audio.</p>
                                                                            <button class="light-grey-btn">Upload Video</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="canvs-row add-more text-center">
                                            <a href="#add-cnvs-component-popup" class="plus-add-more-c" data-toggle="modal">+ Add more component</a>
                                        </div>
                                    </div>
                                    <div class="canvs-components-right-sec">
                                        <div style="margin-top: 0" class="common-row">
                                            <div class="img-or-video-prev">
                                                <img src="img/use-temp-img-prev.jpg">
                                            </div>
                                            <h1>Add Context</h1>
                                            <p>Change the text and use this space to tell people about your product, brand, or service. </p>
                                            <button class="big-black-bordered-btn">Write something ...</button>
                                        </div>
                                        <div class="common-row">
                                            <div class="img-or-video-prev">
                                                <img src="img/use-temp-img-prev.jpg">
                                            </div>
                                            <h1>Add Context</h1>
                                            <p>Change the text and use this space to tell people about your product, brand, or service. </p>
                                            <button class="big-black-bordered-btn">Write something ...</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li>
        <div class="r">
            <input type="radio" name="full-scrn-options">
        </div>
        <div class="des">
            Use existing Canvas
        </div>
    </li>
    </ul>