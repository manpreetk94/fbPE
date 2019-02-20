 <div class="row main-heading">
	                    <h5 class="white-block-legend" style="border-bottom: 0">
			            Ad Preview
			            </h5>
	                </div>
	                <div class="white-block-body">
	                    <div class="row">
	                        <div class="col-md-9 ads-preview-dropd-down-list">
	                            <a href="#" class="light-grey-btn slctd-prev">Mobile News Feed <i class="fa fa-caret-down" aria-hidden="true"></i></a>
	                            <ul class="preview_type">
	                                <li class="item1 active"><img src="img/ads-list-icon1.jpg"> Mobile News Feed</li> 
	                                <li class="item2"><img src="img/ads-list-icon1.jpg"> Desktop New Feed</li>
	                                <li class="item3"><img src="img/ads-list-icon1.jpg">Instant Artical</li>
	                                <li class="item4"><img src="img/ads-list-icon1.jpg"> Facebook In Stream Video (Mobile)</li>
	                                <li class="item5"><img src="img/ads-list-icon1.jpg">  Facebook In Stream Video (Desktop)</li>
	                                <li class="item6"><img src="img/ads-list-icon1.jpg"> Desktop Right Column</li>
	                                <li class="item7"><img src="img/ads-list-icon1.jpg"> Facebook Suggested Video (Mobile)</li>
	                                <li class="item8"><img src="img/ads-list-icon1.jpg">  Facebook Suggested Video (Desktop)</li>
	                                <li class="item9"><img src="img/ads-list-icon1.jpg">Instagram Field</li>
	                                <li class="item10"><img src="img/ads-list-icon1.jpg">Audience Network Out-Stream Video</li>
	                                <li class="item11"><img src="img/ads-list-icon1.jpg">Messenger Mobile Inbox</li>
	                            </ul>
	                        </div>
	                        <div class="col-md-3 text-right " style="padding-right: 50;padding-left:4px;"> <span class="counter">1 </span> of 11</div>
	                    </div>
	                    <div class="row">
	                        <div class="col-md-12 text-center">
	                            <div id="ads-preview-crsl" class="carousel slide" data-ride="carousel">
	                                <div class="carousel-inner">
	                                    <div class="item active" id="item1">
	                                    	<?php echo $MOBILE_FEED_STANDARD; ?>	                                     
	                                    </div>
	                                    <div class="item" id="item2">
	                                        <?php echo $DESKTOP_FEED_STANDARD; ?>
	                                    </div>
	                                    <div class="item" id="item3">
	                                       <?php echo $INSTANT_ARTICLE_STANDARD; ?>
	                                    </div>
	                                    <div class="item" id="item4">
	                                        <?php echo $INSTREAM_VIDEO_MOBILE; ?>
	                                    </div>
	                                    <div class="item" id="item5">
	                                        <?php echo $INSTREAM_VIDEO_DESKTOP; ?>
	                                    </div>
	                                    <div class="item" id="item6">
	                                       <?php echo $RIGHT_COLUMN_STANDARD; ?>
	                                    </div>
	                                    <div class="item" id="item7">
	                                        <?php echo $INSTREAM_VIDEO_MOBILE; ?>
	                                    </div>
	                                    <div class="item" id="item8">
	                                        <?php echo $SUGGESTED_VIDEO_DESKTOP; ?>
	                                    </div>
	                                    <div class="item" id="item9">
	                                       <?php echo $INSTAGRAM_STANDARD; ?>
	                                    </div>
	                                    <div class="item" id="item10">
	                                       <?php if($AUDIENCE_NETWORK_OUTSTREAM_VIDEO!=''){ 
	                                       			echo $AUDIENCE_NETWORK_OUTSTREAM_VIDEO; 
	                                       		}else{
	                                       			echo '<p>This ad Format is not currently supported or Rewarded video.</p>';
	                                       		}
	                                       	?>
	                                    </div>
	                                    <div class="item" id="item11">
	                                       <?php if($MESSENGER_MOBILE_INBOX_MEDIA!=''){ 
	                                       			echo $MESSENGER_MOBILE_INBOX_MEDIA; 
	                                       		}else{
	                                       			echo '<p>This ad Format is not currently supported or Rewarded video.</p>';
	                                       		}
	                                       	?>
	                                    </div>
	                                </div>
	                                <!-- Left and right controls -->
	                                <a class="left carousel-control" href="#ads-preview-crsl" data-slide="prev">
	                                    <span class="glyphicon glyphicon-chevron-left"></span>
	                                    <span class="sr-only">Previous</span>
	                                </a>
	                                <a class="right carousel-control" href="#ads-preview-crsl" data-slide="next">
	                                    <span class="glyphicon glyphicon-chevron-right"></span>
	                                    <span class="sr-only">Next</span>
	                                </a>
	                            </div>
	                        </div>
	                    </div>
	                </div>