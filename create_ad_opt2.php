<?php

function getImageByHash($hash=null,$hashs){

    if(!empty($hashs['adimages']['data'])){
        
        foreach($hashs['adimages']['data'] as $adimg){
             
           if($adimg['hash']==$hash){
              echo '<img src="'.$adimg['url_128'].'" width="70px" height="70px" class="thumb selected-img-thumb" >';
           }
        }
    }
           
                 
}
?>
<?php
	$child = count($creative['object_story_spec']['link_data']['child_attachments']);
	$link_data = $creative['object_story_spec']['link_data'];
	$multi_share_optimized = $creative['object_story_spec']['link_data']['multi_share_optimized'];
	$multi_share_end_card = $creative['object_story_spec']['link_data']['multi_share_end_card'];
?>
    <div class="manual-and-dynamic-cont">
        <h5>Images/Videos and Links </h5>       
        <div class="manual-imgs-radio-opt">
            <div class="common-row">
                <label>Text</label>
                <textarea class="form-control cmessage" placeholder="Enter text that clearly tells people about what you're promoting" style="font-size:12px" name="cmessage_opt2"><?php echo $creative['body'];?></textarea>
            </div>
            <div class="common-row">
                <h5>Destination </h5>
                <div class="common-row">
                    <input type="radio" name="web-url" id="web-url" <?php if(isset($link_data['child_attachments'][0]['link'])){ echo 'checked';}?>>
                    <label for="web-url">Website URL</label>
                </div>
                <div class="common-row">
                    <input type="radio" name="web-url" id="mess-setup"  <?php if(!isset($link_data['child_attachments'][0]['link'])){ echo 'checked'; }?>>
                    <label for="mess-setup">Messenger Setup </label>
                    <p>Create the first few messages people see in Messenger after they click on your ad</p>
                    <span class="light-grey-btn set-up-message-popup" data-target="#set-up-message-popup" data-toggle="modal">Set up message</span>
                </div>
                <div class="common-row">
                    <input type="checkbox" name="multi_share_optimized" <?php if($multi_share_optimized=='true'){ echo 'checked';}?> >
                    <label>Automatically show the best performing card first</label>
                </div>
                <div class="common-row">
                    <input type="checkbox" name="multi_share_end_card" <?php if($multi_share_end_card=='true'){ echo 'checked';}?> >
                    <label>Add a card at end with your Page profile picture</label>
                </div>

                <div class="common-row cards-imgs">
                    <a href="#" class="select-card-link">Select card from previous ads</a>
                     
                        <ul class="nav nav-tabs crsl-slide">
                            <?php
                            $cnt =$child;
                            if($child>0){
                                for($i=0; $i<$child;$i++){
                                    ?>
                                     <li class="<?php if($i==0){ echo 'active'; } ?>"><a data-toggle="tab" href="#crsl-slide-dynamic-tab<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                                    <?php
                                }
                            }else{ 
                            		$cnt = '3';
                            	?>
                                <li class="active"><a data-toggle="tab" href="#crsl-slide-dynamic-tab1">1</a></li>
                                <li class=""><a data-toggle="tab" href="#crsl-slide-dynamic-tab2">2</a></li>
                                <li class=""><a data-toggle="tab" href="#crsl-slide-dynamic-tab3">3</a></li>
                            <?php }
                            ?>
                            <li class="add_more_tab" rel="<?php echo $cnt+1; ?>" ><a data-toggle="tab" href="#">+</a></li>
                        </ul>
                        

                        <div class="tab-content apd_mul_image">
                        
                            <?php if($child>0): ?>
                                <?php foreach($creative['object_story_spec']['link_data']['child_attachments'] as $key=>$crt): ?> 
                                <div id="crsl-slide-dynamic-tab<?php echo $key; ?>" class="tab-pane fade <?php if($key==0){ echo 'in active'; } ?>">
                                    <div class="img-and-video-radio-opt-for-cards">
                                       <div class="img-video-radio-tabs">
                                            <ul class="nav nav-tabs">
                                                <li class="<?php if(!isset($crt['video_id'])) { echo 'active';} ?>  mul-crv-typ"  rel="<?php echo $key; ?>" token="image" id="#img_vid<?php echo $key; ?>">
                                                    <a data-toggle="tab" href="#radio-tab-img<?php echo $key; ?>" aria-expanded="true">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="child_attachments[<?php echo $key ?>][mul-wid-type]" id="img-mul-type<?php echo $key; ?>" <?php if(!isset($crt['video_id'])) { echo 'checked';} ?> value="image" >
                                                            <label for="img-mul-type<?php echo $key; ?>">Image</label>
                                                            <div class="check"></div>
                                                        </label>
                                                    </a>
                                                </li>
                                                <li class="<?php if(isset($crt['video_id'])) { echo 'active';} ?> mul-crv-typ" token="video" id="#vid_vid<?php echo $key; ?>" rel="<?php echo $key; ?>">
                                                    <a data-toggle="tab" href="#radio-tab-vid<?php echo $key; ?>" aria-expanded="false">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="child_attachments[<?php echo $key ?>][mul-wid-type]" id="vid-mul-type<?php echo $key; ?>"  <?php if(isset($crt['video_id'])) { echo 'checked';} ?> value="video" >
                                                            <label for="vid-mul-type<?php echo $key; ?>"
                                                                >Video / Slideshow</label>
                                                            <div class="check"></div>
                                                        </label>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div id="radio-tab-img<?php echo $key; ?>" class="img-radio-tab-cont tab-pane <?php if(!isset($crt['video_id'])) { echo 'active';} ?>">
                                                    <div class="select-img-row select_img<?php echo $key; ?>">
                                                        <span class="light-grey-btn common-select-img-popup mul_images_popup" rel="<?php echo $key; ?>">Select Images</span>
                                                    </div>
                                                    <input type="hidden" value="<?php echo $crt['image_hash']; ?>" name="child_attachments[<?php echo $key ?>][image_hash]" class="image_hash<?php echo $key; ?>">
                                                    <p class="text-right clear_image" rel="<?php echo $key; ?>">Clear Images</p>
                                                    <span id="selected_images<?php echo $key; ?>">
                                                        <?php
                                                     
                                                        if(isset($crt['image_hash'])){
                                                             //echo $crt['image_hash'];
                                                            echo getImageByHash($crt['image_hash'],$hashs);
                                                        }
                                                        ?>
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
                                                <div id="radio-tab-vid<?php echo $key; ?>" class="video-slideshow-radio-tab-cont tab-pane <?php if(isset($crt['video_id'])) { echo 'active';} ?>">

                                                    <div class="select-img-row select_vid<?php echo $key; ?>">
                                                        <span class="light-grey-btn common-select-video-popup" rel="<?php echo $key; ?>">Select Video</span>
                                                    </div>
                                                  

                                                    <input type="hidden" value="<?php echo $crt['video_id']; ?>" name="child_attachments[<?php echo $key ?>][video_id]" class="video_id<?php echo $key; ?>">


                                                    <p class="text-right clear_video" rel="<?php echo $key; ?>">Clear Video</p>
                                                    <span id="selected_videos<?php echo $key; ?>">
                                                        <?php
                                                     
                                                        if(isset($crt['image_hash'])){
                                                             //echo $crt['image_hash'];
                                                            echo getImageByHash($crt['image_hash'],$hashs);
                                                        }
                                                    ?>
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
                                                  <div class="destination-row website_dest">
                                                        <div class="common-row">
                                                            <h5>Destination URL  </h5>
                                                            <input type="text" class="form-control" name="child_attachments[<?php echo $key ?>][link]" value="<?php echo $crt['link']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="destination-row">
                                                        <div class="common-row">
                                                            <h5>Headline</h5>
                                                            <input type="text" class="form-control" name="child_attachments[<?php echo $key ?>][name]"  value="<?php echo $crt['name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="destination-row">
                                                        <div class="common-row">
                                                            <h5>Description  (optional)</h5>
                                                            <input type="text" class="form-control" name="child_attachments[<?php echo $key ?>][description]"  value="<?php echo $crt['description']; ?>">
                                                        </div>
                                                    </div>
                                                 
                                                   
                                                    <div class="destination-row">
                                                        <div class="common-row">
                                                            <h5>Call to Action</h5>
                                                            <div class="custom-autocomplete-select call-to-ac-lrn-more">
                                                                <select class="selectpicker show-tick call_to_action_mul" data-size="8" name="child_attachments[<?php echo $key ?>][call_to_action][type]">
                                                                    <option value="NO_BUTTON" <?php if($crt['call_to_action']['type']=="NO_BUTTON") { echo 'selected';}?>>No Button</option>
                                                                    <option value="LISTEN_NOW" <?php if($crt['call_to_action']['type']=="LISTEN_NOW") { echo 'selected';}?>>Listen Now</option>
                                                                    <option value="REQUEST_TIME" <?php if($crt['call_to_action']['type']=="REQUEST_TIME") { echo 'selected';}?>>Request Time</option>
                                                                    <option value="SEE_MENU" <?php if($crt['call_to_action']['type']=="SEE_MENU") { echo 'selected';}?>>See Menu</option>
                                                                    <option value="SHOP_NOW" <?php if($crt['call_to_action']['type']=="SHOP_NOW") { echo 'selected';}?>>Shop Now</option>
                                                                    <option value="SIGN_UP" <?php if($crt['call_to_action']['type']=="SIGN_UP") { echo 'selected';}?>>Sign Up</option>
                                                                    <option value="WATCH_MORE" <?php if($crt['call_to_action']['type']=="WATCH_MORE") { echo 'selected';}?>>Watch More</option>
                                                                    <option value="MESSAGE_PAGE" <?php if($crt['call_to_action']['type']=="MESSAGE_PAGE") { echo 'selected';}?>>Send Message</option>
                                                                    <option value="APPLY_NOW" <?php if($crt['call_to_action']['type']=="APPLY_NOW") { echo 'selected';}?>>Apply Now</option>
                                                                    <option value="OPEN_LINK" <?php if($crt['call_to_action']['type']=="OPEN_LINK") { echo 'selected';}?>>Open Link</option>
                                                                    <option value="LIKE_PAGE" <?php if($crt['call_to_action']['type']=="LIKE_PAGE") { echo 'selected';}?>>Like Page</option>
                                                                    <option value="PLAY_GAME" <?php if($crt['call_to_action']['type']=="PLAY_GAME") { echo 'selected';}?>>Play Game</option>
                                                                    <option value="INSTALL_APP" <?php if($crt['call_to_action']['type']=="INSTALL_APP") { echo 'selected';}?>>Install App</option>
                                                                    <option value="USE_APP" <?php if($crt['call_to_action']['type']=="USE_APP") { echo 'selected';}?>>use App</option>
                                                                    <option value="INSTALL_MOBILE_APP" <?php if($crt['call_to_action']['type']=="INSTALL_MOBILE_APP") { echo 'selected';}?>>Install Mobile App</option>
                                                                    <option value="USE_MOBILE_APP" <?php if($crt['call_to_action']['type']=="USE_MOBILE_APP") { echo 'selected';}?>>Use Mobile App</option>
                                                                    <option value="LISTEN_MUSIC" <?php if($crt['call_to_action']['type']=="LISTEN_MUSIC") { echo 'selected';}?>>Listen Music</option>
                                                                    <option value="BOOK_TRAVEL" <?php if($crt['call_to_action']['type']=="BOOK_TRAVEL") { echo 'selected';}?>>Book Travel</option>
                                                                    <option value="LEARN_MORE" <?php if($crt['call_to_action']['type']=="LEARN_MORE") { echo 'selected';}?>>Learnn More</option>
                                                                    <option value="DOWNLOAD" <?php if($crt['call_to_action']['type']=="DOWNLOAD") { echo 'selected';}?>>Download</option>
                                                                    <option value="BUY_NOW" <?php if($crt['call_to_action']['type']=="BUY_NOW") { echo 'selected';}?>>Buy Now</option>
                                                                    <option value="GET_OFFER" <?php if($crt['call_to_action']['type']=="GET_OFFER") { echo 'selected';}?>>Get Offer</option>
                                                                    <option value="GET_OFFER" <?php if($crt['call_to_action']['type']=="GET_OFFER") { echo 'selected';}?>>Get Offer Now</option>
                                                                    <option value="GET_DIRECTIONS" <?php if($crt['call_to_action']['type']=="GET_DIRECTIONS") { echo 'selected';}?>>Get Direction</option>
                                                                    <option value="MESSAGE_USER" <?php if($crt['call_to_action']['type']=="MESSAGE_USER") { echo 'selected';}?>>Message User</option>
                                                                    <option value="SUBSCRIBE" <?php if($crt['call_to_action']['type']=="SUBSCRIBE") { echo 'selected';}?>>Subscribe</option>
                                                                    <option value="SELL_NOW" <?php if($crt['call_to_action']['type']=="SELL_NOW") { echo 'selected';}?>>Sell Now</option>
                                                                    <option value="DONATE_NOW" <?php if($crt['call_to_action']['type']=="DONATE_NOW") { echo 'selected';}?>>Donate Now</option>
                                                                    <option value="GET_QUOTE" <?php if($crt['call_to_action']['type']=="GET_QUOTE") { echo 'selected';}?>>Get Quote</option>
                                                                    <option value="CONTACT_US" <?php if($crt['call_to_action']['type']=="CONTACT_US") { echo 'selected';}?>>Contact Us</option>
                                                                    <option value="START_ORDER" <?php if($crt['call_to_action']['type']=="START_ORDER") { echo 'selected';}?>>Start Order</option>
                                                                    <option value="RECORD_NOW" <?php if($crt['call_to_action']['type']=="LISTEN_NOW") { echo 'selected';}?>>Record Now</option>
                                                                    <option value="VOTE_NOW" <?php if($crt['call_to_action']['type']=="VOTE_NOW") { echo 'selected';}?>>Vote Now</option>
                                                                    <option value="REGISTER_NOW" <?php if($crt['call_to_action']['type']=="REGISTER_NOW") { echo 'selected';}?>>Register Now</option>
                                                                    <option value="REQUEST_TIME" <?php if($crt['call_to_action']['type']=="REQUEST_TIME") { echo 'selected';}?>>Request Time</option>
                                                                    <option value="SEE_MENU" <?php if($crt['call_to_action']['type']=="SEE_MENU") { echo 'selected';}?>>See Menu</option>
                                                                    <option value="EMAIL_NOW" <?php if($crt['call_to_action']['type']=="EMAIL_NOW") { echo 'selected';}?>> Email Now</option>
                                                                    <option value="GET_SHOWTIMES" <?php if($crt['call_to_action']['type']=="GET_SHOWTIMES") { echo 'selected';}?>>Get Showtimes</option>
                                                                    <option value="TRY_IT" <?php if($crt['call_to_action']['type']=="TRY_IT") { echo 'selected';}?>>Try It</option>
                                                                    <option value="LISTEN_NOW" <?php if($crt['call_to_action']['type']=="LISTEN_NOW") { echo 'selected';}?>>Listen Now</option>
                                                                    <option value="OPEN_MOVIES" <?php if($crt['call_to_action']['type']=="OPEN_MOVIES") { echo 'selected';}?>> Open Movies</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end common fields-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php  endforeach; ?>

                            <?php else: ?>

                                <?php include 'mul_image_in_opt2.php';?>
                               


                            <?php  endif; ?>

                               <!-- <div class="destination-row">
                                    <div class="common-row">
                                        <h5>See more url <i class="fa fa-info-circle"></i></h5>
                                        <input type="text" class="form-control" name="link" value="<?php echo $link_data['link']; ?>">
                                    </div>
                               </div>
                               
                                <div class="destination-row">
                                    <div class="common-row">
                                        <h5>See more display link (optional)<i class="fa fa-info-circle"></i></h5>
                                        <input type="text" class="form-control caption" name="caption" value="<?php echo $link_data['caption']; ?>">
                                    </div>
                                </div> -->
                          
                        </div>                    

                </div>
            </div>
        </div>
   
    </div>
