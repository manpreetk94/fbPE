

<?php for($j=1;$j<=3;$j++):?>
<div id="crsl-slide-dynamic-tab<?php echo $j; ?>" class="tab-pane fade <?php if($j==1){ echo 'in active'; } ?>">
    <div class="img-and-video-radio-opt-for-cards">
       <div class="img-video-radio-tabs">
            <ul class="nav nav-tabs">
                 <li class="active mul-crv-typ" rel="<?php echo $j; ?>" token="image" id="#img_vid<?php echo $j; ?>">
                    <a data-toggle="tab" href="#radio-tab-img<?php echo $j; ?>" aria-expanded="true">
                        <label class="radio-inline">
                            <input type="radio" name="child_attachments[<?php echo $j; ?>][mul-wid-type]" id="img-mul-type<?php echo $j; ?>" value="image"> 
                            <label for="img-mul-type<?php echo $j; ?>">Image</label>
                            <div class="check"></div>
                        </label>
                    </a>
                </li>
                <li class="mul-crv-typ" rel="<?php echo $j; ?>" token="video" id="#vid_vid<?php echo $j; ?>">
                    <a data-toggle="tab" href="#radio-tab-vid<?php echo $j; ?>"  token="video" id="#vid_vid<?php echo $j; ?>" rel="<?php echo $tab; ?>" aria-expanded="false">
                        <label class="radio-inline">
                            <input type="radio" name="child_attachments[<?php echo $j; ?>][mul-wid-type]" id="vid-mul-type<?php echo $j; ?>" value="video">
                            <label for="vid-mul-type<?php echo $j; ?>">Video / Slideshow</label>
                            <div class="check"></div>
                        </label>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- <div id="radio-tab3" class="img-radio-tab-cont tab-pane active"> -->
                  <div id="radio-tab-img<?php echo $j; ?>" class="img-radio-tab-cont tab-pane active">
                    <div class="select-img-row">
                        <span class="light-grey-btn common-select-img-popup" data-target="#common-select-img-popup" data-toggle="modal">Select Images</span>
                    </div>

                    <div class="img-specification">
                        <h5>IMAGE SPECIFICATIONS</h5>
                        <ul>
                            <li>Recommended image size: 1200 × 628 pixels</li>
                            <li>Recommended image ratio: 1.91:1</li>
                            <li>To maximize ad delivery, use an image that contains little or no overlaid text.</li>
                        </ul>
                    </div>


                </div>
                <!-- <div id="radio-tab4" class="video-slideshow-radio-tab-cont tab-pane"> -->
                <div id="radio-tab-vid<?php echo $j; ?>" class="video-slideshow-radio-tab-cont tab-pane">

                    <div class="select-img-row select_vid<?php echo $j; ?>">
                        <span class="light-grey-btn common-select-video-popup" rel="<?php echo $j; ?>">Select Video</span>
                    </div>
                  

                    <input type="hidden" value="" name="child_attachments[<?php echo $j; ?>][video_id]" class="video_id<?php echo $j; ?>">


                    <p class="text-right clear_video" rel="<?php echo $j; ?>">Clear Video</p>
                    <span id="selected_videos<?php echo $j; ?>">                        
                    </span>
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

                <!-- coomon fields -->
                  <div class="destination-row">
                        <div class="common-row">
                            <h5>Destination URL  <i class="fa fa-info-circle"></i></h5>
                            <input type="text" class="form-control" name="child_attachments[<?php echo $j; ?>][link]">
                        </div>
                    </div>
                    <div class="destination-row">
                        <div class="common-row">
                            <h5>Headline <i class="fa fa-info-circle"></i></h5>
                            <input type="text" class="form-control" name="child_attachments[<?php echo $j; ?>][name]" >
                        </div>
                    </div>
                    <div class="destination-row">
                        <div class="common-row">
                            <h5>Description  (optional) <i class="fa fa-info-circle"></i></h5>
                            <input type="text" class="form-control" name="child_attachments[<?php echo $j; ?>][description]"  >
                        </div>
                    </div>
                  
                    <div class="destination-row">
                        <div class="common-row">
                            <h5>Call to Action<i class="fa fa-info-circle"></i></h5>
                            <div class="custom-autocomplete-select call-to-ac-lrn-more">
                                <select class="selectpicker show-tick call_to_action_image" data-size="8"  name="child_attachments[<?php echo $j; ?>][call_to_action][type]">
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
                    <!-- end common fields-->
            </div>
        </div>
    </div>
</div>
<?php endfor;?>

