<?php
/**
 *Template Name: Patient Form 1
 */
?>

<?php get_header(); ?>






<h2 class="icon-book"></h2>
    <section class="item-list row container">




        <form class="patient-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="form" value="patient_form" />
        <div class="response"></div>

        <div id="accordion" class="row spaced">

            <h5 class="patient-form-1 icon-angle-right">Personal Information - 1 of 3
                <a href="<?php the_field('form_1'); ?>" target="_blank" class="pdf">
                    <span>PDF  <i class="fa fa-file"></i> </span>
                </a>
            </h5>

            <div class="content boxed main-form">
                <h4>Patient Information</h4>

                <div class="row">
                    <label class="w33">
                        <input type="text" name="first_name" required="required" />
                        <p>
                            <span class="static">First Name</span>
                            <span class="animate">First Name</span>
                        </p>
                    </label>
                    <label class="w33">
                        <input type="text" name="middle_name" />
                        <p>
                            <span class="static">Middle Name</span>
                            <span class="animate">Middle Name</span>
                        </p>
                    </label>
                    <label class="w33">
                        <input type="text" name="last_name" required="required" />
                        <p>
                            <span class="static">Last Name</span>
                            <span class="animate">Last Name</span>
                        </p>
                    </label>
                </div>

                <div class="row">
                    <label class="w50">
                        <input type="email" name="email" required="required" />
                        <p>
                            <span class="static">E-mail</span>
                            <span class="animate">E-mail</span>
                        </p>
                    </label>

                    <label class="w50">
                        <input type="text" name="street_address" required="required" />
                        <p>
                            <span class="static">Street Address</span>
                            <span class="animate"><!-- Street Address --> <em>Please Put in a valid Street Address</em></span>
                        </p>
                    </label>
                </div>

                <div class="row">
                    <label class="w33">
                        <input type="text" name="zip_code" required="required" />
                        <p>
                            <span class="static">Zip Code</span>
                            <span class="animate">Zip Code</span>
                        </p>
                    </label>
                    <label class="w33">
                        <input type="text" name="city" required="required" />
                        <p>
                            <span class="static">City</span>
                            <span class="animate">City</span>
                        </p>
                    </label>
                    <label class="w33" for="state">

                        <select name="state" id="state" required="required">
                            <option value="UT">UT</option>
                            <option value="">--- Choose State ---</option>
                            <option value="AL">AL</option>
                            <option value="AK">AK</option>
                            <option value="AZ">AZ</option>
                            <option value="AR">AR</option>
                            <option value="CA">CA</option>
                            <option value="CO">CO</option>
                            <option value="CT">CT</option>
                            <option value="DE">DE</option>
                            <option value="FL">FL</option>
                            <option value="GA">GA</option>
                            <option value="GU">GU</option>
                            <option value="HI">HI</option>
                            <option value="ID">ID</option>
                            <option value="IL">IL</option>
                            <option value="IN">IN</option>
                            <option value="IA">IA</option>
                            <option value="KS">KS</option>
                            <option value="KY">KY</option>
                            <option value="LA">LA</option>
                            <option value="ME">ME</option>
                            <option value="MD">MD</option>
                            <option value="MA">MA</option>
                            <option value="MI">MI</option>
                            <option value="MN">MN</option>
                            <option value="MS">MS</option>
                            <option value="MO">MO</option>
                            <option value="MT">MT</option>
                            <option value="NE">NE</option>
                            <option value="NV">NV</option>
                            <option value="NH">NH</option>
                            <option value="NJ">NJ</option>
                            <option value="NM">NM</option>
                            <option value="NY">NY</option>
                            <option value="NC">NC</option>
                            <option value="ND">ND</option>
                            <option value="OH">OH</option>
                            <option value="OK">OK</option>
                            <option value="OR">OR</option>
                            <option value="PA">PA</option>
                            <option value="PR">PR</option>
                            <option value="RI">RI</option>
                            <option value="SC">SC</option>
                            <option value="SD">SD</option>
                            <option value="TN">TN</option>
                            <option value="TX">TX</option>
                            <option value="UT">UT</option>
                            <option value="VT">VT</option>
                            <option value="VA">VA</option>
                            <option value="WA">WA</option>
                            <option value="WV">WV</option>
                            <option value="WI">WI</option>
                            <option value="WY">WY</option>

                        </select>
                        <p>
                            <span>State</span>
                        </p>
                    </label>
                </div>

                <div class="row">
                    <label class="w33">
                        <input type="tel" name="home_phone" class="phone" required="required" pattern="\(\d\d\d\) \d\d\d\-\d\d\d\d" title="(XXX) XXX-XXXX" placeholder="(XXX) XXX-XXXX" />
                        <p>
                            <span class="static">Primary Number</span>
                            <span class="animate">Primary Number</span>
                        </p>
                    </label>
                    <label class="w33">
                        <input type="tel" name="cell_phone" class="phone" pattern="\(\d\d\d\) \d\d\d\-\d\d\d\d" title="(XXX) XXX-XXXX" placeholder="(XXX) XXX-XXXX" />
                        <p>
                            <span class="static">Cell Number</span>
                            <span class="animate">Cell Number</span>
                        </p>
                    </label>
                    <label class="w33">
                        <input type="tel" name="work_phone" class="phone" pattern="\(\d\d\d\) \d\d\d\-\d\d\d\d" title="(XXX) XXX-XXXX" placeholder="(XXX) XXX-XXXX" />
                        <p>
                            <span class="static">Work Number</span>
                            <span class="animate">Work Number</span>
                        </p>
                    </label>
                </div>

                <div class="row">
                    <label class="w33">
                        <input type="text" name="date_of_birth" class="date" required="required" />
                        <p>
                            <span class="static">Date of Birth</span>
                            <span class="animate">Date of Birth</span>
                        </p>
                    </label>
                    <label class="w33">
                        <input type="text" name="social_security_number" class="ss"  required="required" />
                        <p>
                            <span class="static">Social Security Number</span>
                            <span class="animate">Social Security Number</span>
                        </p>
                    </label>
                    <label class="w33">
                        <select name="gender" required="required">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <p>Gender</p>
                    </label>
                </div>

                <div class="row">
                    <label class="w33">
                        <select name="marital_status">
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>
                        </select>
                        <p>Marital Status</p>
                    </label>
                    <label class="w33">

                        <select name="employment_status" required="required">
                            <option value="full-time">Full Time</option>
                            <option value="part-time">Part Time</option>
                            <option value="retired">Retired</option>
                        </select>
                        <p>Employment</p>
                    </label>
                    <label class="w33">
                        <input type="text" name="primary_care_physician" />
                        <p>
                            <span class="static">Primary Care Physician</span>
                            <span class="animate">Primary Care Physician</span>
                        </p>
                    </label>
                </div>

                <div class="row">
                    <label class="w50">

                        <select name="patient_relationship_to_responsible_party" required="required">
                            <option value="self">Self</option>
                            <option value="spouse">Spouse</option>
                            <option value="child">Child</option>
                            <option value="other">Other</option>
                        </select>
                        <p>Patient Relationship to Responsible Party</p>
                    </label>
                    <!-- If "Patient Relationship to Responsible Party" = "Other" -->
                    <label class="w50 other">
                        <input type="text" name="patient_relationship_to_responsible_party_other" />
                        <p>
                            <span class="static">Other</span>
                            <span class="animate">Other</span>
                        </p>
                    </label>
                     <!-- END If "Patient Relationship to Responsible Party" = "Other" -->
                </div>

                <h5>Patient's Employer Information</h5>

                <div class="row">
                    <label class="w66">
                        <input type="text" name="patient_employer_company" required="required" />
                        <p>
                            <span class="static">Company</span>
                            <span class="animate">Company</span>
                        </p>
                    </label>
                    <label class="w33">
                        <input type="text" name="patient_employer_city" required="required" />
                        <p>
                            <span class="static">City</span>
                            <span class="animate">City</span>
                        </p>
                    </label>
                </div>

                <h5 class="na-info">Accident Information <span><input type="checkbox" name="accident_information_not_applicable" class="na-checkbox" style="display: block !important;" />N/A</span></h5><span class="small-msg">(Complete this if you are being treated due to an accidental injury.)</span>

                <div class="na-info-content">
                    <div class="row">
                        <label class="w33">
                            <input type="text" class="date" name="accident_date_of_incident" />
                            <p>
                                <span class="static">Date</span>
                                <span class="animate">Date</span>
                            </p>
                        </label>
                        <label class="w33">

                            <select name="accident_type">
                                <option value="work related">Work Related</option>
                                <option value="auto">Auto</option>
                                <option value="other">Other</option>
                            </select>
                            <p>Employment</p>
                        </label>
                        <!-- If "Employment" = "Other" -->
                        <label class="w33 other">
                            <input type="text" name="accident_type_other" />
                            <p>
                                <span class="static">(Other) Employment</span>
                                <span class="animate">(Other) Employment</span>
                            </p>
                        </label>
                         <!-- END If "Employment" = "Other" -->
                    </div>
                    <div class="row">
                        <label class="w50">
                            <input type="text" name="accident_work_related_supervisor" />
                            <p>
                                <span class="static">If work related, Supervisor</span>
                                <span class="animate">If work related, Supervisor</span>
                            </p>
                        </label>
                        <label class="w50">
                            <input type="tel" name="accidental_work_related_supervisor_phone" pattern="\(\d\d\d\) \d\d\d\-\d\d\d\d" title="(XXX) XXX-XXXX" placeholder="(XXX) XXX-XXXX" />
                            <p>
                                <span class="static">Phone</span>
                                <span class="animate">Phone</span>
                            </p>
                        </label>
                    </div>
                </div>

                <div class="spesh-box pf1">
                    <div class="row">
                        <label class="w100">
                            <p class="w50">Were you referred to us by your optometrist? If so, who?</p>
                            <span class="w50">
                                <input  type="text" name="referring_optometrist"/>
                            </span>
                        </label>
                    </div>
                    <div class="row">
                        <div class="w100">
                            <p class="w33">Were you referred to us by a:</p>
                            <label class="w33">

                                <select class="w100" name="referred_to_us_by">
									<option>Choose Option</option>
                                    <option value="friend">Friend</option>
                                    <option value="family">Family Member</option>
                                    <option value="other">Other</option>
                                </select>
                            </label>
                            <!-- If Other,  -->
                            <label class="w33 other hide">
                                <p class="w33">Other</p>
                                <input class="w66" type="text" name="referred_to_us_by_other" />
                            </label>
                            <!-- End If Other,  -->
                        </div>
                    </div>
					<?php /*
                    <div class="row">
                        <div class="w100">
                            <p class="w33">How else did you hear about us?</p>
                            <label class="w22">
                                <input type="checkbox" name="referred_by_radio" class="w referred_by" id="referred_by_radio" value="Radio" /><p class="w100"><i class="fa fa-check"></i> Radio</p>
                            </label>
                            <label class="w22">
                                <input type="checkbox" name="referred_by_newspaper"  class="w referred_by" id="referred_by_newspaper"  value="Newspaper" /><p class="w100"><i class="fa fa-check"></i> Newspaper</p>
                            </label>
                            <label class="w22 force-last">
                                <input type="checkbox" name="referred_by_magazine"  class="w referred_by" id="referred_by_magazine" value="Magazine" /><p class="w100"><i class="fa fa-check"></i> Magazine</p>
                            </label>
                        </div>
                    </div>
					*/ ?>
                    <!-- <if radio> -->
                    <div class="row referred_by_radio referred_by_row">
                        <p class="w33">
                            What Radio Station?
                        </p>
                        <label class="w33">

                            <select name="referred_by_radio_station">
                                <option>Choose Option</option>
								<option value="x96">X96</option>
                                <option value="94.9">94.9</option>
                                <option value="97.1">97.1</option>
                                <option value="98.7">98.7</option>
								<option value="93.3">KUBL 93.3</option>
								<option value="94.1">KODJ 94.1</option>
								<option value="96.3">KXRK 96.3</option>
								<option value="97.9">KBZN 97.9</option>
								<option value="105.1">KUDD 105.1</option>
								<option value="105.9">KNRS 105.9FM</option>
								<option value="106.7">KAAZ 106.7</option>
                                <option value="other">Other</option>
                            </select>
                        </label>
                        <!-- If "What Radio Station?" = "Other" -->
                        <label class="w33 other hide">
                            <p class="w33">Other</p>
                            <input class="w66" type="text" name="referred_by_radio_other" />
                        </label>
                        <!-- END "What Radio Station?" = "Other" -->
                    </div>
                    <!-- </if radio> -->
                    <!-- <if newspaper> -->
                    <div class="row referred_by_newspaper referred_by_row">
                        <p class="w33">
                            What Newspaper?
                        </p>
                        <label class="w33">

                            <select name="referred_by_newspaper_company">
								<option>Choose Option</option>
                                <option value="sltribune">SL Tribune</option>
                                <option value="deseretnews">Deseret News</option>
                                <option value="other">Other</option>
                            </select>
                        </label>
                        <!-- If "What Newspaper?" = "Other" -->
                        <label class="w33 other hide">
                            <p class="w33">Other</p>
                            <input class="w66" type="text" name="referred_by_newspaper_other" />
                        </label>
                        <!-- END "What Newspaper?" = "Other -->
                    </div>
                    <!-- </if newspaper> -->
                    <!-- <if tv> -->
                    <!--<div class="row referred_by_magazine referred_by_row">
                        <p class="w33">
                            What TV Channel?
                        </p>
                        <label class="w66">
                            <input type="text" name="referred_by_tv"/>
                        </label>
                    </div>-->
                    <!-- </if tv> -->
                    <!-- <if newspaper> -->
                    <div class="row referred_by_magazine referred_by_row">
                        <p class="w33">
                            What Magazine?
                        </p>
                        <label class="w33">

                            <select name="referred_by_magazine_company">
								<option>Choose Option</option>
                                <option value="hometownvalues">Hometown Values</option>
                                <option value="healthyutah">Healthy Utah</option>
                                <option value="other">Other</option>
                            </select>
                        </label>
                        <!-- If "What Magazine?" = "Other" -->
                        <label class="w33 other hide">
                            <p class="w33">Other</p>
                            <input class="w66" type="text" name="referred_by_magazine_other" />
                        </label>
                        <!-- END If "What Magazine?" = "Other" -->
                    </div>
                    <!-- </if newspaper> -->
                </div>
                <h4 class="na-info">Responsible (Or Insured) Party Information <span><input type="checkbox" name="responsible_party_self" class="self-checkbox" style="display: block !important;" />Self</span></h4>

                <div class="na-info-content">
                    <div class="row">
                        <label class="w33">
                            <input type="text" name="responsible_party_first_name"  required="required" />
                            <p>
                                <span class="static">First Name</span>
                                <span class="animate">First Name</span>
                            </p>
                        </label>
                        <label class="w33">
                            <input type="text" name="responsible_party_middle_name"/>
                            <p>
                                <span class="static">Middle Name</span>
                                <span class="animate">Middle Name</span>
                            </p>
                        </label>
                        <label class="w33">
                            <input type="text" name="responsible_party_last_name" required="required" />
                            <p>
                                <span class="static">Last Name</span>
                                <span class="animate">Last Name</span>
                            </p>
                        </label>
                    </div>
                    <div class="row">
                        <label class="w25">
                            <input type="text" name="responsible_party_address" required="required" />
                            <p>
                                <span class="static">Address</span>
                                <span class="animate">Address</span>
                            </p>
                        </label>
                        <label class="w25">
                            <input type="text" class="date" name="responsible_party_date_of_birth" required="required" />
                            <p>
                                <span class="static">Date of Birth</span>
                                <span class="animate">Date f Birth</span>
                            </p>
                        </label>
                        <label class="w25">
                            <input type="text" placeholder="XXX-XX-XXXX" class="ss" name="responsible_party_social_security_number" required="required" />
                            <p>
                                <span class="static">Social Security Number</span>
                                <span class="animate">Social Security Number</span>
                            </p>
                        </label>
                        <label class="w25">

                            <select name="responsible_party_gender" required="required" >
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <p>Gender</p>
                        </label>
                    </div>
                    <div class="row">
                        <label class="w33">
                            <input type="tel" name="responsible_party_phone"  required="required" pattern="\(\d\d\d\) \d\d\d\-\d\d\d\d" title="(XXX) XXX-XXXX" placeholder="(XXX) XXX-XXXX" />
                            <p>
                                <span class="static">Phone Number</span>
                                <span class="animate">Phone Number</span>
                            </p>
                        </label>
                        <label class="w33">
                            <input type="tel" name="responsible_party_work_phone" pattern="\(\d\d\d\) \d\d\d\-\d\d\d\d" title="(XXX) XXX-XXXX" placeholder="(XXX) XXX-XXXX" />
                            <p>
                                <span class="static">Work Phone Number</span>
                                <span class="animate">Work Phone Number</span>
                            </p>
                        </label>
                        <label class="w33">
                            <input type="email" name="responsible_party_email" required="required"  />
                            <p>
                                <span class="static">Email</span>
                                <span class="animate">Email</span>
                            </p>
                        </label>
                    </div>

                    <div class="row">
                        <label class="w66">
                            <input type="text" name="responsible_party_company" required="required" />
                            <p>
                                <span class="static">Company</span>
                                <span class="animate">Company</span>
                            </p>
                        </label>
                        <label class="w33">
                            <input type="text" name="responsible_party_city" required="required"  />
                            <p>
                                <span class="static">City</span>
                                <span class="animate">City</span>
                            </p>
                        </label>
                    </div>
                </div>

                <h4 class="na-info">Insurance Information <span><input type="checkbox" name="insurance_not_applicable" class="na-checkbox" style="display: block !important;" />N/A</span></h4>

                <div class="na-info-content">
                    <!-- Repeat if Add New -->
                    <div id="insurance-company" class="company">
                        <div class="row">
                            <label class="w33">
                                <input type="text" name="insurance_company" required="required" />
                                <p>
                                    <span class="static insurance-company-label">Primary Insurance Company</span>
                                    <span class="animate insurance-company-animate">Primary Insurance Company</span>
                                </p>
                            </label>
                            <label class="w33">
                                <input type="text" name="insurance_address" required="required"  />
                                <p>
                                    <span class="static">Address</span>
                                    <span class="animate">Address</span>
                                </p>
                            </label>
                            <label class="w33">
                                <input type="tel" name="insurance_phone" required="required" pattern="\(\d\d\d\) \d\d\d\-\d\d\d\d" title="(XXX) XXX-XXXX" placeholder="(XXX) XXX-XXXX" />
                                <p>
                                    <span class="static">Phone Number</span>
                                    <span class="animate">Phone Number</span>
                                </p>
                            </label>
                        </div>
                        <div class="row">

                            <label class="w25">
                                <input type="text" name="insurance_subscribers_name" required="required" />
                                <p>
                                    <span class="static">Subscriber's Name</span>
                                    <span class="animate">Subscriber's Name</span>
                                </p>
                            </label>
                            <label class="w50">

                                <select name="insurance_patient_relationship_to_subscriber" required="required" >
                                    <option value="self">Self</option>
                                    <option value="spouse">Spouse</option>
                                    <option value="child">Child</option>
                                    <option value="other">Other</option>
                                </select>
                                <p>
                                    Patient Relationship to Subscriber
                                </p>
                            </label>
                            <!-- If Patient Relationship to Subscriber = "Other' -->
                            <label class="w25 other hide">
                                <input type="text" name="insurance_relationship_to_subscriber_other"/>
                                <p>
                                    <span class="static">(Other)</span>
                                    <span class="animate">(Other)</span>
                                </p>
                            </label>
                            <!-- End if-->

                        </div>
                        <div class="row">
                            <label class="w25">
                                <input type="text" name="insurance_contract_id_number" required="required" />
                                <p>
                                    <span class="static">Contract (ID#) Number</span>
                                    <span class="animate">Contract (ID#) Number</span>
                                </p>
                            </label>
                             <label class="w25">
                                <input type="text" name="insurance_group_number" required="required" />
                                <p>
                                    <span class="static">Group Number</span>
                                    <span class="animate">Group Number</span>
                                </p>
                            </label>
                            <label class="w25">
                                <span class="input-icon">$</span>
                                <input type="number" name="insurance_copayment_amount" required="required" />
                                <p>
                                    <span class="static">Co-Payment Amount </span>
                                    <span class="animate">Co-Payment Amount</span>
                                </p>
                            </label>
                            <label class="w25">
                                <input type="text" class="date" name="insurance_insureds_date_of_birth" required="required"  />
                                <p>
                                    <span class="static">Insured's Date of Birth</span>
                                    <span class="animate">Insured's Date of Birth</span>
                                </p>
                            </label>
                        </div>
                        <!-- </ Repeat if Add new >-->
                    </div>
                    <span class="button switched" id="add-secondary-insurance">Add Secondary Insurance Company <i class="fa fa-plus"></i></span>
                </div>

                <br />
                <button class="patient-form-next">Next
                    <i class="fa fa-angle-right"></i>
                </button>
            </div>

            <h5 class="patient-form-2 icon-angle-right">HEALTH HISTORY - 2 of 3
                <a href="<?php the_field('form_2'); ?>" target="_blank" class="pdf">
                    <span>PDF  <i class="fa fa-file"></i> </span>
                </a>
            </h5>

            <div class="content boxed main-form">
                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="asthma">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Asthma</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="head_or_spinal_injuries">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Head or Spinal Injuries</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="kidney_disease">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Kidney Disease</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="seizures_convulsions_fainting">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Seizures, Convulsions, or Fainting</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="tuberculosis">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Tuberculosis</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="extensive_confinement_by_illness_or_injury">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Extensive Confinement by Illness or Injury</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="diabetes_iddm_type_ii">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Diabetes IDDM/Type II - # of yrs.</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="temporal_arteritis">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Temporal Arteritis</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="insulin">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Insulin</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="suffering_any_other_disease">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Suffering from any other disease</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="migraines">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Migraines</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="cartoid_artery_disease">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Carotid Artery Disease</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="psychiatric_disorder">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Psychiatric disorder</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="permanent_defect_from_illness_disease_or_injury">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Permanent defect from Illness, Disease or Injury</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="any_nervous_disorder">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Any nervous disorder</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="flomax">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Have you ever taken Flomax, even once?</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="heart_disease">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Heart Disease</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="stroke">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Stroke</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="ulcer">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Ulcer</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="hiv">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>HIV</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="high_blood_pressure">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>High Blood Pressure</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="sickle_cell_anemia">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Sickle Cell Anemia</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="use-tobacco">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Tobacco</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="use-alcohol">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Alcohol</p>
                            </label>
                        </div>
                    </div>

					<div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="use-autoimmune">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Autoimmune or Collagen Vascular Disease</p>
                            </label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="w50 user-list">
                            <label class="w100">
                                <h6>Please List All Medication / Vitamins You Are Taking: <br>(Note: Add one item per line)</h6>
                                <input name="medications_and_vitamins" id="medication" class="medication" />
                            </label>
                            <span id="add-medication" class="button switched">Add Item <i class="fa fa-plus fa-lg"></i> </span>
                        </div>
                        <div class="w50 user-list">
                            <label class="w100">
                                <h6>Please List All Allergies: <br>(Note: Add one item per line)</h6>
                                <input name="allergies" id="allergy" class="allergy" />
                            </label>
                            <span id="add-allergy" class="button switched">Add Item <i class="fa fa-plus fa-lg"></i> </span>
                        </div>
                    </div>

                    <h4>YOUR OCULAR HISTORY <em>(Have you been diagnosed with any of the following in the past?)</em></h4>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="cataracts">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Cataracts</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="cornea_disease">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Cornea Disease</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="retina_disease">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Retina Disease</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="glaucoma">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Glaucoma</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="crossed_eyes">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Crossed Eyes</p>
                            </label>
                        </div>
                        <div class="w50">
                            <label class="w25">

                                <select name="injury">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Injury</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50">
                            <label class="w25">

                                <select name="iritis">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Iritis</p>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="w50 user-list">
                            <label class="w100">
                                <h6>Other Eye Disorders (Note: Add one item per line)</h6>
                                <input name="eye_disorder" id="eye-disorder" class="eye-disorder" />
                            </label>
                            <span id="add-eye-disorder" class="button switched">Add Item <i class="fa fa-plus fa-lg"></i> </span>
                        </div>
                    </div>

                    <h4>Family History <em>(Has anyone in your family (blood relative) had any of the following? )</em></h4>

                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="glaucoma_family_history" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Glaucoma</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members ">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="glaucoma_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="glaucoma_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="glaucoma_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="glaucoma_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="glaucoma_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="glaucoma_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="glaucoma_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="glaucoma_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="glaucoma_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="glaucoma_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->
                    </div>
                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="diabetes" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Diabetes IDDM/Type II</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="diabetes_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="diabetes_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="diabetes_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="diabetes_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="diabetes_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="diabetes_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="diabetes_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="diabetes_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="diabetes_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="diabetes_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->
                    </div>

                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="cataracts_family_history" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Cataracts</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="cataracts_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="cataracts_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="cataracts_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="cataracts_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="cataracts_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="cataracts_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="cataracts_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="cataracts_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="cataracts_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="cataracts_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->
                    </div>

                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="heart" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Heart</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="heart_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="heart_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="heart_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="heart_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="heart_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="heart_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="heart_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="heart_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="heart_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="heart_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->
                    </div>

                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="cornea_disease_family_history" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Cornea Disease</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="cornea_disease_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="cornea_disease_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="cornea_disease_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="cornea_disease_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="cornea_disease_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="cornea_disease_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="cornea_disease_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="cornea_disease_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="cornea_disease_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="cornea_disease_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->
                    </div>

                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="diabetic_retinopathy" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Diabetic Retinopathy</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="diabetic_retinopathy_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="diabetic_retinopathy_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="diabetic_retinopathy_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="diabetic_retinopathy_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="diabetic_retinopathy_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="diabetic_retinopathy_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="diabetic_retinopathy_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="diabetic_retinopathy_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="diabetic_retinopathy_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="diabetic_retinopathy_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->
                    </div>

                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="macular_degeneration" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Macular Degeneration</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="macular_degeneration_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="macular_degeneration_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="macular_degeneration_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="macular_degeneration_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="macular_degeneration_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="macular_degeneration_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="macular_degeneration_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="macular_degeneration_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="macular_degeneration_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="macular_degeneration_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->
                    </div>

                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="retinal_detachment" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Retinal Detachment</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="retinal_detachment_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="retinal_detachment_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="retinal_detachment_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="retinal_detachment_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="retinal_detachment_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="retinal_detachment_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="retinal_detachment_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="retinal_detachment_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="retinal_detachment_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="retinal_detachment_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->
                    </div>

                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="retinitis_pigmentosa" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Retinitis Pigmentosa</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="retinitis_pigmentosa_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="retinitis_pigmentosa_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="retinitis_pigmentosa_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="retinitis_pigmentosa_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="retinitis_pigmentosa_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="retinitis_pigmentosa_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="retinitis_pigmentosa_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="retinitis_pigmentosa_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="retinitis_pigmentosa_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="retinitis_pigmentosa_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->
                    </div>

                    <div class="row family-history-row">
                        <div class="w50">
                            <label class="w25">

                                <select name="stroke_family_history" class="family-history">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </label>
                            <label class="w75">
                                <p>Stroke</p>
                            </label>
                        </div>

                        <!-- If yes -->
                        <div id="choose-family-members" class="w50 family-members">
                            <div class="fam-tree">
                                <div class="tab">
                                    <i class="fa fa-angle-down"></i>
                                    <h6>Choose Family Member(s)</h6>
                                </div>
                                <label class="">
                                    <input name="stroke_father" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Father</p>
                                </label>

                                <label>
                                    <input name="stroke_mother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Mother</p>
                                </label>

                                <label>
                                    <input name="stroke_paternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Paternal</p>
                                </label>

                                <label>
                                    <input name="stroke_maternal" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Maternal</p>
                                </label>

                                <label>
                                    <input name="stroke_sister" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Sister</p>
                                </label>

                                <label>
                                    <input name="stroke_brother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Brother</p>
                                </label>

                                <label>
                                    <input name="stroke_grandfather" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandfather</p>
                                </label>

                                <label>
                                    <input name="stroke_grandmother" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Grandmother</p>
                                </label>

                                <label>
                                    <input name="stroke_uncle" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Uncle</p>
                                </label>

                                <label>
                                    <input name="stroke_aunt" type="checkbox" />
                                    <span><i class="fa fa-check"></i><i class="fa fa-times"></i></span>
                                    <p>Aunt</p>
                                </label>
                            </div>
                        </div>
                        <!-- End If yes -->

                    </div>

                    <div class="row">
                        <div class="w50 user-list">
                            <label class="w100">
                                <h6>Other Eye Problems (Note: Add one item per line)</h6>
                                <input name="other_eye_problems" id="other-eye-problems" class="other-eye-problems" />
                            </label>
                            <span id="add-other-eye-problems" class="button switched">Add Item <i class="fa fa-plus fa-lg"></i> </span>
                        </div>
                        <div class="w50 user-list">
                            <label class="w100">
                                <h6>Other General Health Problems (Note: Add one item per line)</h6>
                                <input name="other_general_problems" id="other-general-problems" class="other-general-problems" />
                            </label>
                            <span id="add-other-general-problems" class="button switched">Add Item <i class="fa fa-plus fa-lg"></i> </span>
                        </div>
                    </div>

                    <h4>SURGICAL HISTORY</h4>

                    <div id="surgery" class="surgery row">

                        <label class="w33">
                            <h6>Date of Surgery <br>(Note: Add one item per line)</h6>
                            <input type="text"  class="date surgery-date" name="surgery_date" class="surgery-date" />
                        </label>

                        <label class="w66">
                            <h6>Type of surgery </h6><br>
                            <input type="text" name="surgery_type" class="surgery-type text" />
                        </label>

                    </div>

                    <span id="add-surgery" class="button switched">Add Surgery<i class="fa fa-plus fa-lg"></i> </span>

                    <br />
                    <button class="patient-form-next">Next
                        <i class="fa fa-angle-right"></i>
                    </button>

            </div>

            <h5 class="patient-form-3  icon-angle-right">Terms and Conditions - 3 of 3
                <a href="<?php the_field('form_3'); ?>" target="_blank" class="pdf">
                    <span>PDF  <i class="fa fa-file"></i> </span>
                </a>
            </h5>

            <div class="content boxed main-form">

                <h4 class="print-hide">WE APPRECIATE THE OPPORTUNITY OF SERVING YOU. WE PLEDGE TO GIVE YOU OUR VERY BEST MEDICAL CARE.</h4>

                <div class="row terms">
                    <h6>INSURANCE POLICY: </h6>
                    <p>Insurance provides for your reimbursement on allowed medical charges. As a courtesy to you, we will provide an
                        itemized statement that you may send to your insurance company for payment. We will be happy to submit to most
                        insurance carriers if you have provided us with policy numbers, address, place of employment and any other pertinent
                        information. You are responsible for all deductibles and charges not covered by insurance. Please understand that we
                        cannot, as a third party, become involved in prolonged insurance negotiations: this is your responsibility.<br /><br />
                        I authorize the release of any medical information necessary to process any claim. I permit a copy of the authorization
                        to be used in place of the original. This authorization may be revoked by either me or my insurance company at any
                        time in writing.</p>
                    <h6>AUTHORIZATION FOR RELEASE OF MEDICAL RECORDS: </h6>
                    <p>
                        I authorize the Doctor to release any medical information including diagnosis, x-rays, test results, reports and records
                        pertaining to any treatment or examination rendered to me. I understand that this medical information may be used for
                        any of the following procedures: diagnostic, insurance, legal, scientific research, publications, presentations, and at times when the Doctor deems it necessary in
                        order to ensure the best medical care on my behalf. I further understand that any person(s) that receive these medical
                        records will not release any of the medical information obtained by this authorization to any person or organization
                        without further authorization signed by me for release of the information.
                    </p>
                    <h6>TERMS AND CONDITIONS</h6>
                    <p>Customer agrees to pay a finance charge of one and one-half percent (1 ½%) per month on all amounts due and owing
                        to Hoopes Vision Correction Center, EyeSurg of Utah or Laser and Refractive Surgery Center of Utah. </p>
                    <h6>ATTORNEY’S FEES AND COSTS:</h6>
                    <p>If any legal action is necessary to enforce the terms of this Agreement, or if it is necessary to employ the services of
                        an attorney to enforce the terms of this Agreement, the party in default or in breach hereof agrees to pay the other
                        party’s reasonable attorney’s fees and court costs in addition to any other relief to which it may be entitled if
                        Customer fails to pay any amounts owing hereunder when due, or otherwise breaches any terms of this Agreement.
                        Customer agrees to pay up to a 40% collection expense incurred by Hoopes Vision Correction Center in attempting to
                        collect such amounts from Customer, in addition to the aforementioned attorney’s fees and cost</p>
                </div>

                <div class="row sign">

                    <div class="w50">
                        <div class="w20" style="height: 1px">

                        </div>
                        <label class="w30">
                            <p class="bold">Signed</p>
							<input type="text" class="no-cursive" name="terms_conditions_signature" required="required" />

                        </label>
                        <label class="w50 no-cursive">
                            <input type="text" class="no-cursive" name="terms_conditions_signature" required="required" />
                        </label>
                    </div>
                    <!--                        <label class="box w40">-->
                    <!--                            <input type="checkbox" />-->
                    <!--                            <p><i class="fa fa-check fa-lg"></i></p>-->
                    <!--                            <h6>I agree to the Terms and Conditions</h6>-->
                    <!--                        </label>-->
                    <label class="w10">
                        <p class="bold">Date</p>
                    </label>
                    <label class="w30">
                        <input type="text" class="date" name="terms_conditions_signature_date" required="required" />
                    </label>
                </div>

                <h5 class="row">IN CASE OF EMERGENCY PLEASE CONTACT:</h5>

                <div class="row">
                    <label class="w50">
                        <input type="text" name="emergency_contact_name"  required="required" />
                        <p>Name</p>
                    </label>
                    <label class="w50">
                        <input type="tel" name="emergency_contact_phone" pattern="\(\d\d\d\) \d\d\d\-\d\d\d\d" title="(XXX) XXX-XXXX" placeholder="(XXX) XXX-XXXX" required="required" />
                        <p>Phone Number</p>
                    </label>
                </div>

                <div class="row">
                    <label class="w50">
                        <input type="text" name="emergency_contact_relationship" required="required" >
                        <p>Relationship</p>
                    </label>
                    <label class="w50">
                        <input type="text" name="emergency_contact_address" required="required" >
                        <p>Address</p>
                    </label>
                </div>

                <div class="spesh-box">
                    <h5>NOTICE OF PRIVACY PRACTICES </h5>
                    <p>I,  <input type="text" class="fixed-width" name="privacy_practice_acknowledgement" required="required"/>  acknowledge that I have received a copy of Hoopes Vision Correction Center
                        “Notice of Privacy Practices”. This Notice describes how Hoopes Vision Correction Center may use and disclose my
                        protected health information, certain restrictions on the use and disclosure of my healthcare information, and rights I
                        may have regarding my protected health information.</p>
                    <div class="row">

                        <!--                                <label class="box w40">-->
                        <!--                                    <input type="checkbox" />-->
                        <!--                                    <p><i class="fa fa-check fa-lg"></i></p>-->
                        <!--                                    <h6>Signature of Patient, or Personal Representative </h6>-->
                        <!--                                </label>-->

                        <label class="w30">
                            <p class="bold"> Signature of Patient, or Personal Representative </p>
                        </label>
                        <label class="w20 no-cursive">
                            <input type="text" class="no-cursive" name="privacy_practice_signature" required="required" />
                        </label>


                        <label class="w10">
                            <p class="bold">Date</p>
                        </label>
                        <label class="w20">
                            <input type="text" name="privacy_practice_signature_date" class="date" required="required" />
                        </label>

                    </div>

                    <div class="row">
                        <label class="w100">
                            <input type="text" name="privacy_practice_relationship_to_patient" required="required" />
                            <p>Relationship to Patient</p>
                        </label>
                    </div>

                </div>

                <button class="patient-form-submit" type="submit">Submit <i class="fa fa-spinner fa-spin"></i></button>
            </div>

        </div>
        </form>
    </section>

<?php get_footer(); ?>
