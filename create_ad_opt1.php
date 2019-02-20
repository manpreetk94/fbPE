 <div class="two-tabs-first-radio">
    <div class="crt-ad-radio-desc fullscreen-canvas">
        <b>Fullscreen Experience</b>
        <p>Add a fullscreen Canvas, a mobile experience that opens instantly from your ad. Start with a template or create a custom layout with photos, videos and links to get people to engage with your business and encourage them to take action.</p>
    </div>
    <div class="full-scrn-canvs-opt fullscreen-canvas">
         <?php include 'canvas.php';?>
    </div>
    <div class="img-and-video-radio-opt">
        <div class="img-video-radio-tabs">
            <ul class="nav nav-tabs">
                <li class="radio-tab1">
                    <a href="#radio-tab1" data-toggle="tab">
                        <label class="radio-inline">
                            <input id="img-wid-type" name="img-wid-type" type="radio" value="image">
                            <label for="img-wid-type">Image</label>
                            <div class="check"></div> 
                        </label>
                    </a>
                </li>
                <li class="radio-tab2">
                    <a href="#radio-tab2" data-toggle="tab">
                        <label class="radio-inline">
                            <input id="vid-wid-type" name="img-wid-type" type="radio" value="video">
                            <label for="vid-wid-type">Video / Slideshow</label>
                            <div class="check"></div> 
                        </label>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="img-radio-tab-cont tab-pane" id="radio-tab1">
                    <div class="select-img-row select_img">

                    </div>
                    <input type="hidden" value="" name="cimage_hash" class="cimage_hash">
                    <p class="text-right clear_image" rel="option1">Clear Images</p>
                    <span id="selected_images">

                    </span>
                    <div class="img-specification">
                        <h5>IMAGE SPECIFICATIONS</h5>
                        <ul>
                            <li>Recommended image size: 1200 × 628 pixels</li>
                            <li>Recommended image ratio: 1.91:1</li>
                            <li>To maximize ad delivery, use an image that contains little or no overlaid text.</li>
                        </ul>
                    </div>

                </div>
                <div class="video-slideshow-radio-tab-cont tab-pane" id="radio-tab2">
                    <div class="common-row select_vid">
                        
                        

                       <!--  <span class="crt-slideshow-btn light-grey-btn common-create-slideshow-popup image_slideshow" data-target="#common-create-slideshow-popup" data-toggle="modal">
                                   Create Slideshow
                       </span> -->                        

                    </div>
                    <input type="hidden" value="" name="cvideo_id" class="video_id">
                    <p class="text-right clear_video" rel="option1">Clear Video</p>
                    <span id="selected_videos">

                    </span>

                   <!--  <input type="hidden" class="video_id_first_opt" value="" name="video_id_first_opt"> -->
                    <div class="video-specification">

                        <h5>Video Recommendations:</h5>
                        <ul>
                            <li>Recommended Length: Up to 15 seconds</li>
                            <li>Recommended Aspect Ratio: Vertical (4:5)</li>
                            <li>Sound: Enabled with captions included</li>
                        </ul>

                        <h5>Video Specifications:</h5>
                        <ul>
                            <li>Recommended format: .mp4, .mov or .gif</li>
                            <li>Required Lengths By Placement:
                                <ul style="padding-top: 15px;padding-bottom: 5px;">
                                    <li>Facebook: 240 minutes max</li>
                                    <li>Audience Network: 5 - 120 seconds</li>
                                    <li>Instagram Feed: Up to 60 seconds</li>
                                </ul>

                            </li>
                            <li>Resolution: 600px minimum width</li>
                            <li>File size: Up to 4 GB max</li>
                        </ul>

                        <h5>Slideshow Specifications:</h5>
                        <ul>
                            <li>Use high resolution images or a video file to create a slideshow</li>
                            <li>Facebook and Instagram: 50 seconds max</li>
                            <li>Slideshows will loop</li>
                        </ul>
                    </div>
                </div>
                <input type="hidden" name="object_id" class="object_id">
                <div class="destination-row dest_web_mesngr">
                    <h5>Destination </h5>
                    <div class="common-row">
                        <input type="radio" name="dest" class="dest-mngr">
                        <div class="col-md-11" style="padding-left: 0">
                            <b>Website URL</b> 
                            <br>
                            <input type="text" name="website_url" class="form-control website_url link" value="">
                        </div>
                        <!-- <div class="common-row">
                            <input type="radio" name="dest" name="msngr">
                            <div class="col-md-11" style="padding-left: 0">
                                <b>Messenger Setup</b> <i class="fa fa-info-circle"></i>
                                <br>
                                <p>Create the first few messages people see in Messenger after they click on your ad.</p>
                                <button class="light-grey-btn set-up-message-popup" data-target="#set-up-message-popup" data-toggle="modal">Set up message</button>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="common-row">
                    <label>Display Link</label>
                    <input type="url" class="form-control caption adcre link" value="" name="caption">
                </div>
                <div class="common-row">
                    <label>Text</label>
                    <textarea class="form-control cmessage adcre" placeholder="Enter text that clearly tells people about what you're promoting" name="cmessage"></textarea>
                </div>
                <div class="common-row">
                    <label>Headline</label>
                    <input type="text" class="form-control ctext adcre" value="" name="ctext">
                </div>
                <div class="common-row">
                    <label>News Feed Link Description </label>
                    <textarea class="form-control cdescription adcre" placeholder="Enter text that clearly tells people about what you're promoting" name="cdescription"></textarea>
                </div>
                <div class="common-row">
                    <label>Call To Action </label>
                    <br>
                    <div class="custom-autocomplete-select call-to-ac-lrn-more">
                        <select class="selectpicker show-tick call_to_action_image" data-size="8" name="call_to_action_image">
                            <option value="NO_BUTTON">No Button</option>
                            <option value="LISTEN_NOW">Listen Now</option>
                            <option value="REQUEST_TIME">Request Time</option>
                            <option value="SEE_MENU">See Menu</option>
                            <option value="SHOP_NOW">Shop Now</option>
                            <option value="SIGN_UP">Sign Up</option>
                            <option value="WATCH_MORE">Watch More</option>
                            <option value="MESSAGE_PAGE">Send Message</option>
                            <option value="APPLY_NOW">Apply Now</option>
                            <option value="OPEN_LINK">Open Link</option>
                            <option value="LIKE_PAGE">Like Page</option>
                            <option value="PLAY_GAME">Play Game</option>
                            <option value="INSTALL_APP">Install App</option>
                            <option value="USE_APP">use App</option>
                            <option value="INSTALL_MOBILE_APP">Install Mobile App</option>
                            <option value="USE_MOBILE_APP">Use Mobile App</option>
                            <option value="LISTEN_MUSIC">Listen Music</option>
                            <option value="BOOK_TRAVEL">Book Travel</option>
                            <option value="LEARN_MORE">Learnn More</option>
                            <option value="DOWNLOAD">Download</option>
                            <option value="BUY_NOW">Buy Now</option>
                            <option value="GET_OFFER">Get Offer</option>
                            <option value="GET_OFFER_VIEW">Get Offer Now</option>
                            <option value="GET_DIRECTIONS">Get Direction</option>
                            <option value="MESSAGE_USER">Message User</option>
                            <option value="SUBSCRIBE">Subscribe</option>
                            <option value="SELL_NOW">Sell Now</option>
                            <option value="DONATE_NOW">Donate Now</option>
                            <option value="GET_QUOTE">Get Quote</option>
                            <option value="CONTACT_US">Contact Us</option>
                            <option value="START_ORDER">Start Order</option>
                            <option value="RECORD_NOW">Record Now</option>
                            <option value="VOTE_NOW">Vote Now</option>
                            <option value="REGISTER_NOW">Register Now</option>
                            <option value="REQUEST_TIME">Request Time</option>
                            <option value="SEE_MENU">See Menu</option>
                            <option value="EMAIL_NOW">Email Now</option>
                            <option value="GET_SHOWTIMES">Get Showtimes</option>
                            <option value="TRY_IT">Try It</option>
                            <option value="LISTEN_NOW">Listen Now</option>
                            <option value="OPEN_MOVIES"> Open Movies</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>