<li>
                <div class="custom-autocomplete-select">
                    <select class="selectpicker show-tick column" data-live-search="true" data-size="5">
                         <option value="performance" <?php if($file=='performance'){ echo 'selected';} ?>>Performance (Default)</option>
                        <option value="video_engagement" <?php if($file=='video_engagement'){ echo 'selected';} ?>>Video Engagement</option>
                        <option value="performance_and_click" <?php if($file=='performance_and_click'){ echo 'selected';} ?>>Performance and Click</option>
                    </select>
                </div>
            </li>
            <li>
                <div class="custom-autocomplete-select">
                    <select class="selectpicker show-tick breakdowns" data-live-search="true" data-size="5" name="breakdown">
                      
                        <option data-tokens="clear" value="clear" >Clear all breakdowns</option>
                        <optgroup label="By Time">
                            <option data-tokens="time_range" value="1" >Day</option>
                            <option data-tokens="time_range" value="7" >Week</option>
                            <option data-tokens="time_range" value="14" >2 Week</option>
                            <option data-tokens="time_range" value="30" >Month</option>
                        </optgroup>
                        <optgroup lable="By Delivery">
                            <option data-tokens="breakdowns" value="age">Age</option>
                            <option data-tokens="breakdowns" value="gender">Gender</option>
                            <option data-tokens="breakdowns" value="age,gender">Age and Gender</option>
                            <option data-tokens="breakdowns" value="country">Country</option>
                            <option data-tokens="breakdowns" value="region">Region</option>
                            <option data-tokens="breakdowns" value="dma ">DMA Region </option>
                            <option data-tokens="breakdowns" value="impression_device">Impression Device </option>
                            <option data-tokens="breakdowns" value="device_platform">Platform Device </option>
                            <option data-tokens="breakdowns" value="publisher_platform">Publisher Platform  </option>
                            <option data-tokens="breakdowns" value="publisher_platform">Publisher Platform  </option>
                        </optgroup>
                        <optgroup lable="By Action">                        
	                        <option data-tokens="action_breakdowns" value="action_destination"  > Destination </option>
							<option data-tokens="action_breakdowns" value="action_device" > Conversion Device </option>
							<option data-tokens="action_breakdowns" value="action_reaction"> Post Reaction Type </option>
							<option data-tokens="action_breakdowns" value="action_link_click_destination">Link Click Destination </option>
							<option data-tokens="action_breakdowns" value="action_video_type"> Video View type </option>
							<option data-tokens="action_breakdowns" value="action_video_sound"> Video Sound </option>
							<option data-tokens="action_breakdowns" value="action_carousel_card_name"> Carousal card</option>

                        </optgroup>


                    </select>
                </div>
            </li>