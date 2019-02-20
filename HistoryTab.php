<h1 class="drw-main-heading">Activity History for <span class="dummy_text">Campaign:</span> <span class="camapaign_name">demo</span> <span class="mixed_value" style="display: none;"></h1>
<div class="righ-drw-first-third-tab-cal">
    <!-- <button class="light-grey-btn">This month: Sep 1, 2017 - Sep 21, 2017</button> -->
</div>
<div class="history-table">
    <div class="history-filtering">
        <div class=" custom-autocomplete-select">
            <select class="selectpicker show-tick activity" data-live-search="true" data-size="3" id="activity_type">
                <option value="all">All</option>
                <option value="ACCOUNT">Account</option>
                <option value="CAMPAIGN">Campaigns</option>
                <option value="AD_SET">Adset</option>
                <option value="AD">Ad</option>
                <option value="AUDIENCE">Audience</option>
                <option value="BID">Bid</option>
                <option value="BUDGET">Budget</option>
                <option value="DATE">Date</option>
                <option value="STATUS">Status</option>
                <option value="TARGETING">Targetting</option>
            </select>
            <select class="selectpicker show-tick activity" data-live-search="true" data-size="2" id="activity_by">
                <option value="anyone">By Anyone</option>
                <option value="Facebook">By Facebook</option>               
            </select>
        </div>
    </div>
    <table class="table table-bordered table-inverse table-striped table-hover">
        <thead class="thead-default">
            <tr>
                <th>Activity</th>
                <th>Activity Details</th>
                <th>Item Changed</th>
                <th>Name</th>
                <th>Date and Time</th>
            </tr>
        </thead>
        <tbody id="apd_history">
            <tr> <td colspan="5"><img src="img/load.gif" style="margin-top: 55px; margin-bottom: 55px;margin-right: auto;margin-left: 50%;"></td>
            </tr>
        </tbody>

    </table>

    <!-- <div class="no-more-his-result">
        No more activities to show
    </div> -->
</div>