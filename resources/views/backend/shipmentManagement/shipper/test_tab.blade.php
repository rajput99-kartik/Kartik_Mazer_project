<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabbed Form with Validation</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .tab-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .tab-navigation {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: space-between;
        }

        .tab {
            padding: 10px 15px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 5px 5px 0 0;
            background-color: #f0f0f0;
        }

        .tab.active {
            background-color: #fff;
        }

        .tab-content {
            display: none;
            padding: 20px 0;
        }

        h2 {
            margin: 0;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button.next-tab {
            float: right;
        }

        /* Display the first tab by default */
        .tab-content:first-child {
            display: block;
        }
    </style>
</head>
<body>
    <div class="tab-container">
        <ul class="tab-navigation">
            <li class="tab active" data-tab="tab1">Tab 1</li>
            <li class="tab" data-tab="tab2">Tab 2</li>
            <li class="tab" data-tab="tab3">Tab 3</li>
        </ul>
        <form id="tabbed-form">
            <div class="tab-content" id="tab1">
                <h2>Tab 1 Content</h2>
                <div class="tab-pane" id="companydetails">
                    <form id="compDetailsForm" class="form-horizontal">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="company_name" class="col-form-label">
                                            Company Name<span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" id="company_name" placeholder="Enter Company Name" ="" data-parsley-length="[3,70]" maxlength="70" data-parsley-group="block-1" autocomplete="off" name="company_name" type="text">
                                        <span id="error_company_name"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dba" class="col-form-label">
                                            Doing Business<span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" id="dba" placeholder="Enter Doing Business" data-parsley-length="[3,100]" maxlength="100" ="" autocomplete="off" name="dba" type="text">
                                        <span id="error_dba"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="display_name" class="col-form-label">Reference name to use</label>
                                        <select id="display_name" name="display_name" class="form-control">
                                            <option disabled selected value="">Select Reference Type</option>
                                            <option value="company_name">Company Name</option>
                                            <option value="dba">Doing Business</option>
                                        </select>
                                        <span id="error_display_name"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="shipper_id" class="col-form-label">
                                            Industry Type <span class="text-danger">*</span>
                                        </label>
                                        <select name="industry_type" id="#" title="industry" class="form-control" >
                                            <option disabled selected value="">Select Industry Type</option>
                                            <option value="20">Accommodation and Food Services</option>
                                            <option value="21">Mining, Quarrying, Oil and Gas Extraction</option>
                                            <option value="22">Utilities</option>
                                            <option value="23">Construction</option>
                                            <option value="24">Manufacturing</option>
                                            <option value="25">Wholesale Trade</option>
                                            <option value="26">Retail Trade</option>
                                            <option value="27">Transportation and Warehousing</option>
                                            <option value="28">Information</option>
                                            <option value="29">Real Estate, Rental and Leasing</option>
                                            <option value="30">Management of Companies and Enterprises</option>
                                            <option value="31">Administrative, Support, Waste Management and Remediation Services</option>
                                            <option value="32">Educational Services</option>
                                            <option value="33">Health Care and Social Assistance (Not included Medicines,drugs)</option>
                                            <option value="34">Other Services (except Public Administration)</option>
                                            <option value="35">Financial Activities</option>
                                            <option value="36">Professional and Business Services</option>
                                            <option value="37">Trade, Transportation and Utilities supersector</option>
                                            <option value="38">Industry at a Glance Contacts</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="company_email" class="col-form-label">
                                            E-mail <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control email_special_character" id="company_email" placeholder="Enter Company E-mail" data-parsley-length="[3,80]" maxlength="80" ="" autocomplete="off" name="company_email" type="email">
                                        <span id="error_company_email"></span>
                                        <span class="email_warning text-danger"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="company_phone" class="col-form-label">
                                            Phone <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" id="company_phone" placeholder="Enter Company Phone" data-toggle="input-mask" data-mask-format="(000) 000-0000" data-parsley-length="[10,10]" minlength="10" data-parsley-error-message="it should be 10 digit long" ="" autocomplete="off" name="company_phone" type="text">
                                        <span id="error_company_phone"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="company_fax" class="col-form-label">Fax</label>
                                        <input class="form-control" id="company_fax" placeholder="Enter Company Fax" data-parsley-length="[3,20]" maxlength="20" autocomplete="off" name="company_fax" type="text">
                                        <span id="error_company_fax"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="website" class="col-form-label">Website</label>
                                        <input class="form-control" id="website" placeholder="Enter Website" data-parsley-validate="" formnovalidate="formnovalidate" autocomplete="off" name="website" type="url">
                                        <span id="error_website"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="company_street" class="col-form-label">
                                            Street Address <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" id="company_street" name="company_street" class="form-control" placeholder="Enter office street address" data-parsley-length="[1,35]" maxlength="35" >
                                        <span id="error_company_street"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="company_city" class="col-form-label">
                                            City <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" id="company_city" name="company_city" class="form-control" placeholder="Enter office City" data-parsley-length="[2,35]" maxlength="35" >
                                        <span id="error_company_city"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="company_state" class="col-form-label">
                                            State<span class="text-danger">*</span>
                                        </label>
                                        <select name="company_state" id="select-state" title="state" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                            <option disabled selected value="">Select State</option>
                                            <option value="Alaska">Alaska</option>
                                            <option value="Alabama">Alabama</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Arizona">Arizona</option>
                                            <option value="Arkansas">Arkansas</option>
                                            <option value="California">California</option>
                                            <option value="Colorado">Colorado</option>
                                            <option value="Connecticut">Connecticut</option>
                                            <option value="Delaware">Delaware</option>
                                            <option value="District of Columbia">District of Columbia</option>
                                            <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                                            <option value="Florida">Florida</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Hawaii">Hawaii</option>
                                            <option value="Idaho">Idaho</option>
                                            <option value="Illinois">Illinois</option>
                                            <option value="Indiana">Indiana</option>
                                            <option value="Iowa">Iowa</option>
                                            <option value="Kansas">Kansas</option>
                                            <option value="Kentucky">Kentucky</option>
                                            <option value="Louisiana">Louisiana</option>
                                            <option value="Maine">Maine</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Maryland">Maryland</option>
                                            <option value="Massachusetts">Massachusetts</option>
                                            <option value="Michigan">Michigan</option>
                                            <option value="Minnesota">Minnesota</option>
                                            <option value="Mississippi">Mississippi</option>
                                            <option value="Missouri">Missouri</option>
                                            <option value="Montana">Montana</option>
                                            <option value="Nebraska">Nebraska</option>
                                            <option value="Nevada">Nevada</option>
                                            <option value="New Hampshire">New Hampshire</option>
                                            <option value="New Jersey">New Jersey</option>
                                            <option value="New Mexico">New Mexico</option>
                                            <option value="New York">New York</option>
                                            <option value="North Carolina">North Carolina</option>
                                            <option value="North Dakota">North Dakota</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Ohio">Ohio</option>
                                            <option value="Oklahoma">Oklahoma</option>
                                            <option value="Oregon">Oregon</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Pennsylvania">Pennsylvania</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Rhode Island">Rhode Island</option>
                                            <option value="South Carolina">South Carolina</option>
                                            <option value="South Dakota">South Dakota</option>
                                            <option value="Tennessee">Tennessee</option>
                                            <option value="Texas">Texas</option>
                                            <option value="Utah">Utah</option>
                                            <option value="Vermont">Vermont</option>
                                            <option value="Virgin Islands">Virgin Islands</option>
                                            <option value="Virginia">Virginia</option>
                                            <option value="Washington">Washington</option>
                                            <option value="West Virginia">West Virginia</option>
                                            <option value="Wisconsin">Wisconsin</option>
                                            <option value="Wyoming">Wyoming</option>
                                            <option value="Armed Forces Africa">Armed Forces Africa</option>
                                            <option value="Armed Forces Americas (except Canada)">Armed Forces Americas (except Canada)</option>
                                            <option value="Armed Forces Canada">Armed Forces Canada</option>
                                            <option value="Armed Forces Europe">Armed Forces Europe</option>
                                            <option value="Armed Forces Middle East">Armed Forces Middle East</option>
                                            <option value="Armed Forces Pacific">Armed Forces Pacific</option>
                                            <option value="British Columbia">British Columbia</option>
                                            <option value="Ontario">Ontario</option>
                                            <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                            <option value="Nova Scotia">Nova Scotia</option>
                                            <option value="Prince Edward Island">Prince Edward Island</option>
                                            <option value="New Brunswick">New Brunswick</option>
                                            <option value="Quebec">Quebec</option>
                                            <option value="Manitoba">Manitoba</option>
                                            <option value="Saskatchewan">Saskatchewan</option>
                                            <option value="Alberta">Alberta</option>
                                            <option value="Northwest Territories">Northwest Territories</option>
                                            <option value="Nunavut">Nunavut</option>
                                            <option value="Yukon Territory">Yukon Territory</option>
                                        </select>
                                        <span id="error_company_state"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="company_country" class="col-form-label">
                                            Country<span class="text-danger">*</span>
                                        </label>
                                        <select name="company_country" id="select-country" title="country" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                            <option disabled selected value="">Select Country</option>
                                            <option value="Canada">Canada</option>
                                            <option value="United States">United States</option>
                                        </select>
                                        <span id="error_company_country"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="company_zip" class="col-form-label">
                                            Zip<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" id="company_zip" name="company_zip" class="form-control zip_code_shipper" placeholder="Enter company Zip" data-parsley-length="[5,6]" minlength="5" maxlength="6" >
                                        <span id="error_company_zip"></span>
                                    </div>
                                </div>
                                <h4 class="header-title mt-2 mb-0">Company Details</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="type_of_business" class="col-form-label">
                                            Type Of Business<span class="text-danger">*</span>
                                        </label>
                                        <select id="type_of_business" name="type_of_business" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                            <option disabled selected value="">Select Business Type</option>
                                            <option value="LLC">LLC</option>
                                            <option value="Corporation">Corporation</option>
                                            <option value="Parternship">Parternship</option>
                                            <option value="Individual">Individual</option>
                                        </select>
                                        <span id="error_type_of_business"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="yrs_in_business" class="col-form-label">Years In Business</label>
                                        <input class="form-control" id="yrs_in_business" placeholder="Enter Yrs in business" data-parsley-validate="" data-parsley-length="[1,3]" maxlength="3" autocomplete="off" name="yrs_in_business" type="text">
                                        <span id="error_yrs_in_business"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="location" class="col-form-label">
                                            Location<span class="text-danger">*</span>
                                        </label>
                                        <select id="location" name="location" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                            <option disabled selected value="">Select Location</option>
                                            <option value="Residential">Residential</option>
                                            <option value="Commercial">Commercial</option>
                                        </select>
                                        <span id="error_location"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="incorp_state" class="col-form-label">
                                            Incorporation State<span class="text-danger">*</span>
                                        </label>
                                        <select name="incorp_state" id="select-incorp-state" title="incorp_state" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                            <option disabled selected value="">Select Incorporation State</option>
                                            <option value="Alaska">Alaska</option>
                                            <option value="Alabama">Alabama</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Arizona">Arizona</option>
                                            <option value="Arkansas">Arkansas</option>
                                            <option value="California">California</option>
                                            <option value="Colorado">Colorado</option>
                                            <option value="Connecticut">Connecticut</option>
                                            <option value="Delaware">Delaware</option>
                                            <option value="District of Columbia">District of Columbia</option>
                                            <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                                            <option value="Florida">Florida</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Hawaii">Hawaii</option>
                                            <option value="Idaho">Idaho</option>
                                            <option value="Illinois">Illinois</option>
                                            <option value="Indiana">Indiana</option>
                                            <option value="Iowa">Iowa</option>
                                            <option value="Kansas">Kansas</option>
                                            <option value="Kentucky">Kentucky</option>
                                            <option value="Louisiana">Louisiana</option>
                                            <option value="Maine">Maine</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Maryland">Maryland</option>
                                            <option value="Massachusetts">Massachusetts</option>
                                            <option value="Michigan">Michigan</option>
                                            <option value="Minnesota">Minnesota</option>
                                            <option value="Mississippi">Mississippi</option>
                                            <option value="Missouri">Missouri</option>
                                            <option value="Montana">Montana</option>
                                            <option value="Nebraska">Nebraska</option>
                                            <option value="Nevada">Nevada</option>
                                            <option value="New Hampshire">New Hampshire</option>
                                            <option value="New Jersey">New Jersey</option>
                                            <option value="New Mexico">New Mexico</option>
                                            <option value="New York">New York</option>
                                            <option value="North Carolina">North Carolina</option>
                                            <option value="North Dakota">North Dakota</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Ohio">Ohio</option>
                                            <option value="Oklahoma">Oklahoma</option>
                                            <option value="Oregon">Oregon</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Pennsylvania">Pennsylvania</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Rhode Island">Rhode Island</option>
                                            <option value="South Carolina">South Carolina</option>
                                            <option value="South Dakota">South Dakota</option>
                                            <option value="Tennessee">Tennessee</option>
                                            <option value="Texas">Texas</option>
                                            <option value="Utah">Utah</option>
                                            <option value="Vermont">Vermont</option>
                                            <option value="Virgin Islands">Virgin Islands</option>
                                            <option value="Virginia">Virginia</option>
                                            <option value="Washington">Washington</option>
                                            <option value="West Virginia">West Virginia</option>
                                            <option value="Wisconsin">Wisconsin</option>
                                            <option value="Wyoming">Wyoming</option>
                                            <option value="Armed Forces Africa">Armed Forces Africa</option>
                                            <option value="Armed Forces Americas (except Canada)">Armed Forces Americas (except Canada)</option>
                                            <option value="Armed Forces Canada">Armed Forces Canada</option>
                                            <option value="Armed Forces Europe">Armed Forces Europe</option>
                                            <option value="Armed Forces Middle East">Armed Forces Middle East</option>
                                            <option value="Armed Forces Pacific">Armed Forces Pacific</option>
                                            <option value="British Columbia">British Columbia</option>
                                            <option value="Ontario">Ontario</option>
                                            <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                            <option value="Nova Scotia">Nova Scotia</option>
                                            <option value="Prince Edward Island">Prince Edward Island</option>
                                            <option value="New Brunswick">New Brunswick</option>
                                            <option value="Quebec">Quebec</option>
                                            <option value="Manitoba">Manitoba</option>
                                            <option value="Saskatchewan">Saskatchewan</option>
                                            <option value="Alberta">Alberta</option>
                                            <option value="Northwest Territories">Northwest Territories</option>
                                            <option value="Nunavut">Nunavut</option>
                                            <option value="Yukon Territory">Yukon Territory</option>
                                        </select>
                                        <span id="error_incorp_state"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="fed_tax_id" class="col-form-label">Fed Tax Id</label>
                                        <input class="form-control" id="fed_tax_id" placeholder="Enter Fed Tax ID" data-parsley-length="[9,9]" minlength="9" maxlength="9" autocomplete="off" name="fed_tax_id" type="text">
                                        <span id="error_fed_tax_id"></span>
                                    </div>
                                    <!--div class="col-md-3"> <label for="dnb" class="col-form-label">D&B</label> <input class="form-control" id="dnb" placeholder="Enter D&amp;B" name="dnb" type="text"> <span id="error_dnb"> </span> </div-->
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        <ul class="list-inline wizard mb-0">
                            <li class="next list-inline-item float-right">
                                <a href="javascript: void(0);" class="btn btn-secondary">Next</a>
                            </li>
                        </ul>
                    </form>
                </div>
                <button type="button" class="next-tab">Next</button>
            </div>
            <div class="tab-content" id="tab2">
                <h2>Tab 2 Content</h2>
                <input type="text" name="field2" placeholder="Field 2" required>
                <button type="button" class="prev-tab">Previous</button>
                <button type="button" class="next-tab">Next</button>
            </div>
            <div class="tab-content" id="tab3">
                <h2>Tab 3 Content</h2>
                <input type="text" name="field3" placeholder="Field 3" required>
                <button type="button" class="prev-tab">Previous</button>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".tab");
            const tabContents = document.querySelectorAll(".tab-content");
            const form = document.getElementById("tabbed-form");
            let currentTab = 0; // Track the current tab

            tabs.forEach((tab, index) => {
                tab.addEventListener("click", () => {
                    if (index < currentTab) {
                        tabs[currentTab].classList.remove("active");
                        tab.classList.add("active");
                        tabContents[currentTab].style.display = "none";
                        tabContents[index].style.display = "block";
                        currentTab = index;
                    } else if (index === currentTab) {
                        // The user clicked on the current tab; no action needed.
                    } else {
                        if (validateFields(currentTab)) {
                            tabs[currentTab].classList.remove("active");
                            tab.classList.add("active");
                            tabContents[currentTab].style.display = "none";
                            tabContents[index].style.display = "block";
                            currentTab = index;
                        } else {
                            alert("Please fill in all required fields before proceeding.");
                        }
                    }
                });
            });

            const nextButtons = document.querySelectorAll(".next-tab");
            const prevButtons = document.querySelectorAll(".prev-tab");

            nextButtons.forEach(nextButton => {
                nextButton.addEventListener("click", e => {
                    e.preventDefault();
                    const currentTab = e.target.closest(".tab-content");
                    const nextTab = currentTab.nextElementSibling;
                    if (nextTab) {
                        if (validateFields(currentTab)) {
                            tabs[currentTab].classList.remove("active");
                            tabContents[currentTab].style.display = "none";
                            tabs[currentTab + 1].classList.add("active");
                            tabContents[currentTab + 1].style.display = "block";
                            currentTab = currentTab + 1;
                        } else {
                            alert("Please fill in all required fields before proceeding.");
                        }
                    }
                });
            });

            prevButtons.forEach(prevButton => {
                prevButton.addEventListener("click", e => {
                    e.preventDefault();
                    const currentTab = e.target.closest(".tab-content");
                    const prevTab = currentTab.previousElementSibling;
                    if (prevTab) {
                        tabs[currentTab].classList.remove("active");
                        tabContents[currentTab].style.display = "none";
                        tabs[currentTab - 1].classList.add("active");
                        tabContents[currentTab - 1].style.display = "block";
                        currentTab = currentTab - 1;
                    }
                });
            });

            form.addEventListener("submit", e => {
                e.preventDefault();
                if (validateFields(currentTab)) {
                    alert("Form submitted successfully!");
                } else {
                    alert("Please fill in all required fields before submitting the form.");
                }
            });

            function validateFields(tabIndex) {
                const requiredInputs = tabContents[tabIndex].querySelectorAll('input[required]');
                for (const input of requiredInputs) {
                    if (!input.value.trim()) {
                        return false;
                    }
                }
                return true;
            }
        });
    </script>
</body>
</html>
