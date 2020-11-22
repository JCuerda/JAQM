/**
 * Author : s4Lv4t0r3
 * Date   : January 13, 2019
 */

var AdminModel = (function(){
    
    /**
     * Rate Object Model
     */
    let Rate = function(id, description, max_post, pricing){
        this.id          = id;
        this.description = description;
        this.max_post    = max_post;
        this.pricing     = pricing;
    };

    /**
     * Rate Data Holder
     */
    let rate = {}

    /**
     * Validate the Rate information passed
     * @param id            - Id of the Rate
     * @param description   - Description of the Rate
     * @param max_post      - Number of post allowed
     * @param pricing       - Pricing
     */
    function validateRate(id, description, max_post, pricing){
        let counter = 0;

        var letters = new RegExp("^[a-zA-Z -]*$");
        var numbers = new RegExp("^[0-9 .]+$"); 

        if(id === 0){
            new PNotify({
                title: 'Validation Error!',
                text: 'No ID Detected',
                type: 'error',
                styling: 'bootstrap3'
            });
            counter++;
        }

        if(description === ''){
            new PNotify({
                title: 'Validation Error!',
                text: 'Description field should not be left blank',
                type: 'error',
                styling: 'bootstrap3'
            });
            counter++;
        }

        if(max_post === ''){
            new PNotify({
                title: 'Validation Error!',
                text: 'Max Post field should not be left blank',
                type: 'error',
                styling: 'bootstrap3'
            });
            counter++;
        } else if(!max_post.match(numbers)){
            new PNotify({
                title: 'Validation Error!',
                text: 'Max Post field should only be consist of numbers',
                type: 'error',
                styling: 'bootstrap3'
            });
            counter++;
        }

        if(pricing === ''){
            new PNotify({
                title: 'Validation Error!',
                text: 'Pricing field should not be left blank',
                type: 'error',
                styling: 'bootstrap3'
            });
            counter++;
        } else if(!pricing.match(numbers)){
            new PNotify({
                title: 'Validation Error!',
                text: 'Pricing field should only be consist of numbers',
                type: 'error',
                styling: 'bootstrap3'
            });
            counter++;
        }

        return counter;
    };

    return {
        /**
         * Public Method that set the Rate Model Data
         * @return $error_counter - If certain Error arise after validation
         */
        setRate: (id, description, max_post, pricing) => {
            let error_counter = validateRate(id, description, max_post, pricing);

            if(error_counter === 0){
                rate = new Rate(id, description, max_post, pricing);
                return error_counter;
            }

            return error_counter;
        },
        /**
         * Method to get the stored rate 
         */
        getRate: () => {
            return rate;
        }
    }

})();

/**
 * View Module of the Administrator
 */
var AdminView = (function(){

    /**
     * Set all the variables and DOM Strings
     * that are used in the Administrator Module
     */
    const DOMStrings = {
        //Tables
        tbl_rates    : 'table#rate-list',
        tbl_company  : 'table#company-list',
        tbl_client   : 'table#client-list',

        //Modals
        modal_edit_rates : 'div#edit-rates-modal',
        modal_edit_body  : 'div#edit-rate-body',
        modal_view_jobs  : 'div#company-jobs',
        modal_matched_jobs : 'div#job-matched',

        //Button
        btn_edit_rates        : 'button#edit-rate-btn',
        btn_save_rate_details : 'button#save-edit-rate-details',
        btn_login_admin       : 'button#admin-login-btn',
        btn_view_comp_jobs    : 'button#view-company-jobs',
        btn_reactivate        : 'button#btn-re-activate',
        btn_deactivate        : 'button#btn-deactivate',
        btn_matched_jobs      : 'button#btn-matched-jobs',

        //Edit Modal Form Component
        txt_input_id          : 'input#rate-id',
        txt_input_description : 'input#edit-rate-description',
        txt_input_max_post    : 'input#edit-rate-post',
        txt_input_pricing     : 'input#edit-rate-pricing',

        //Admin Login
        txt_admin_user        : 'input#admin-name',
        txt_admin_pass        : 'input#admin-pass',

        //Advertise
        tbl_advertise         : 'table#advertise-table',

        //Job List
        panel_job_list         : 'div#job-list',

        //Matched Job Panel
        panel_matched_job      : 'div#matched-job-body'
    };

    return {
        /**
         * Public method to access the DOMStrings
         */
        getDOMStrings : () => {
            return DOMStrings;
        },

        /**
         * Generate Rate Form which will be
         * used in the Saving and Editing Rate 
         * @param rateData - Object that contains rate information
         */
        generateEditRateForm: (rateData) => {

            let component  = '<div class="form-group">';
                component += '    <div class="col-md-12 col-sm-12 col-xs-12">';
                component += '        <label for="" class="control-label">Rate Description</label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>';
                component += '            <input type="hidden" id="rate-id" name="rate_id" class="form-control "  placeholder="" value="'+ rateData.id +'">';
                component += '            <input type="text" id="edit-rate-description" name="edit_rate_description" class="form-control "  placeholder="" value="'+ rateData.description +'">';
                component += '        </div>';
                component += '    </div>';
                component += '</div><!-- form-group -->';
                component += '<div class="form-group">';
                component += '    <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">';
                component += '        <label for="" class="control-label">Max Allowed Post </label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-edit"></i></span>';
                component += '            <input type="text" id="edit-rate-post" name="edit_rate_post" class="form-control "  placeholder="" value="'+ rateData.max_post +'">';
                component += '        </div>';
                component += '    </div>';
                component += '</div><!-- form-group -->';
                component += '<div class="form-group">';
                component += '    <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">';
                component += '        <label for="" class="control-label">Pricing</label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-book"></i></span>';
                component += '            <input type="text" id="edit-rate-pricing" name="edit_rate_pricing" class="form-control "  placeholder="" value="'+ rateData.pricing +'">';
                component += '        </div>';
                component += '    </div>';
                component += '</div><!-- form-group -->';

                return component;
           
        },
        
        generateJobListing: (jobs) => {
            let component = '';
            if(Object.entries(jobs).length!== 0){
                component += '<div class="table-responsive">';
                component += '    <table id="company-jobs" ';
                component += '            class="table table-striped table-bordered dt-responsive nowrap"';
                component += '            cellspacing="0"';
                component += '            width="100%">';
                component += '        <thead>';
                component += '            <tr>';
                component += '                <td class="text-center">#</td>';
                component += '                <td class="text-center"><strong>Job Id</strong> </td>';
                component += '                <td class="text-center"><strong>Position</strong> </td>';
                component += '                <td class="text-center"><strong>Date Posted</strong> </td>';
                component += '            </tr>';
                component += '        </thead>';
                component += '        <tbody>';
                                        let i = 1;
                                        jobs.forEach(j =>{
                component += '                <tr>';
                component += '                    <td class="text-center">'+ i +'</td>';
                component += '                    <td class="text-center">'+ j.id +'</td>';
                component += '                    <td class="text-center" width="auto">'+ j.title +'</td>';
                component += '                    <td class="text-center">'+j.date_posted +'</td>';
                component += '                </tr>';
                                                i++;
                                            });
                component += '        </tbody>';
                component += '    </table>';
                component += '</div>';

            } else {
                component += '<div class="row">';
                component += '    <div class="col-sm-12 text-center">';
                component += '        <div class="wrapper-page">';
                component += '            <img src="'+ DESTINATION +'assets/build/images/animat-search-color.gif" alt="" height="120">';
                component += '            <h2 class="text-uppercase text-danger">No Jobs Found</h2>';
                component += '            <p class="text-muted">No Job Posted by the company yet</p>';
                component += '        </div>';
                component += '    </div>';
                component += '</div>';

            }

            return component;
        },

        generateMatchedJobTable: (jobs) => {
            let component = '';
            if(Object.entries(jobs).length !== 0){
                component += '<div class="table-responsive">';
                component += '    <table id="matched-jobs" ';
                component += '            class="table table-striped table-bordered dt-responsive nowrap"';
                component += '            cellspacing="0"';
                component += '            width="100%">';
                component += '        <thead>';
                component += '            <tr>';
                component += '                <td class="text-center"><strong>Company ID</strong></td>';
                component += '                <td class="text-center"><strong>Company Name</strong> </td>';
                component += '                <td class="text-center"><strong>Position</strong> </td>';
                component += '                <td class="text-center"><strong>Date Posted</strong> </td>';
                component += '                <td class="text-center"><strong>Is Available</strong> </td>';
                component += '                <td class="text-center"><strong>Matching Percentage</strong> </td>';
                component += '            </tr>';
                component += '        </thead>';
                component += '        <tbody>';
                                        jobs.forEach(j =>{
                component += '                <tr>';
                component += '                    <td class="text-center">'+ j.comp_id +'</td>';
                component += '                    <td class="text-center">'+ j.name +'</td>';
                component += '                    <td class="text-center">'+ j.title +'</td>';
                component += '                    <td class="text-center" width="auto">'+ j.date_posted +'</td>';
                component += '                    <td class="text-center" width="auto">'+ j.is_available +'</td>';
                component += '                    <td class="text-center">'+ Math.round(j.percentage_match) +' %</td>';
                component += '                </tr>';
                                            });
                component += '        </tbody>';
                component += '    </table>';
                component += '</div>';
            } else {
                component += '<div class="row">';
                component += '    <div class="col-sm-12 text-center">';
                component += '        <div class="wrapper-page">';
                component += '            <img src="'+ DESTINATION + 'assets/build/images/animat-search-color.gif" alt="" height="120">';
                component += '            <h2 class="text-uppercase text-danger">No Matching Jobs</h2>';
                component += '            <p class="text-muted">No Job Posted that matched applicants qualifications</p>';
                component += '        </div>';
                component += '    </div>';
                component += '</div>';
            }

            return component;
        }
    }
})();

/**
 * Controller Module of the Administrator
 * @param adminModel - The Data Model Module
 * @param adminView  - The View Module
 */
var AdminController = (function(adminModel, adminView){
    
    /**
     * Access the DOM strings that
     * are used in the Administrator Module
     */
    let DOM = adminView.getDOMStrings();

    /**
     * Setup All the Event Listener which
     * will be used in the Administrator Module
     */
    let setUpEventListener = () => {

        let rateTable      = $(DOM.tbl_rates).DataTable({bAutoWidth: false});

        let compTable      = $(DOM.tbl_comp).DataTable({bAutoWidth: false});

        let clientTable    = $(DOM.tbl_client).DataTable({bAutoWidth: false});

        let edit_job       = $(DOM.tbl_rates).on('click', DOM.btn_edit_rates ,editRate);

        let save_edit_rate = $(DOM.btn_save_rate_details).on('click', saveRateDetails);

        let close_modal    = $(DOM.modal_edit_rates).on('hidden.bs.modal', clearEditRateModal);

        let login_admin    = $(DOM.btn_login_admin).on('click', login);

        let view_job_list  = $(DOM.btn_view_comp_jobs).on('click', viewJobs);

        let view_jl_res    = $(DOM.tbl_company).on('click', DOM.btn_view_comp_jobs, viewJobs);

        let hide_job_modal = $(DOM.modal_view_jobs).on('hidden.bs.modal', clearJobModal);
        
        let reactivate     = $(DOM.btn_reactivate).on('click', reActivateCompany);

        let deactivate     = $(DOM.btn_deactivate).on('click', deActivateCompany);

        let r_jobs         = $(DOM.tbl_company).on('click', DOM.btn_reactivate, reActivateCompany);

        let d_jobs         = $(DOM.tbl_company).on('click', DOM.btn_deactivate, deActivateCompany);

        let matched_jobs   = $(DOM.tbl_client).on('click', DOM.btn_matched_jobs, matchedJobModal);

        let hide_match_modal = $(DOM.modal_matched_jobs).on('hidden.bs.modal', clearMatchModal);


        $(window).on('load', function(){
            if($(DOM.tbl_advertise).length > 0){
                $(DOM.tbl_advertise + ' tbody').sortable({
                    update: function(event, ui){
                        $(this).children().each(function(index){
                            if($(this).attr('data-position') != (index + 1)){
                                $(this).attr('data-position', (index + 1)).addClass('updated');
                            }
                        });

                        saveAdvertisementPosition();
                    }
                });
            }
        });

        if($(DOM.tbl_company).length > 0){
            $(DOM.tbl_company).DataTable({bAutoWidth: false});
        }
    };

    function clearMatchModal(){
        $(panel_matched_job).html("");
    }

    function matchedJobModal(){
        let applicant_id = $(this).data('applicant-id');
        $.ajax({
            url: DESTINATION + 'administrator/view_job/' + applicant_id,
            type: 'GET',
            success: (response) => {
                
                let jobs = JSON.parse(response);

                let component  = adminView.generateMatchedJobTable(jobs);
                $(DOM.panel_matched_job).html(component);
                $(DOM.panel_matched_job + ' table#matched-jobs').DataTable({bAutoWidth: false, aaSorting: []});
                $(DOM.modal_matched_jobs).modal({show: true});
            } 
        });
    }


    function reActivateCompany(){
        let company_id = $(this).data('company-id');
        
        swal({
            title: 'Warning!',
            text: 'Are you sure you want to reactivate the company?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, reactivate it!",
            closeOnConfirm: false
        }, () => {
            $.ajax({
                url: DESTINATION + 'administrator/reactivate',
                type: 'POST',
                data: {
                    company_id: company_id
                },
                success: (response) => {
                    let result = JSON.parse(response);
                    if(result === true){
                        swal({
                            title: 'Success!',
                            text: 'Successfully Reactivated the company!',
                            type: 'success',
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        }, () => {
                            window.location.reload();
                        });
                    } else {
                        swal({
                            title: 'Error!',
                            text: 'An error occured during reactivation!',
                            type: 'error',
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        });
                    }
                }
            });
        });
    }

    function deActivateCompany(){
        let company_id = $(this).data('company-id');
        
        swal({
            title: 'Warning!',
            text: 'Are you sure you want to deactivate the company?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Yes, deactivate it!",
            closeOnConfirm: false
        }, () =>{
            $.ajax({
                url: DESTINATION + 'administrator/deactivate',
                type: 'POST',
                data: {
                    company_id: company_id
                },
                success: (response) => {
                    let result = JSON.parse(response);
                    if(result === true){
                        swal({
                            title: 'Success!',
                            text: 'Successfully Deactivated the company!',
                            type: 'success',
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        }, () => {
                            window.location.reload();
                        });
                    } else {
                        swal({
                            title: 'Error!',
                            text: 'An Error occured during deactivation!',
                            type: 'error',
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        });
                    }
                }
            });
        });
    }

    function clearJobModal(){
        $(DOM.panel_job_list).html("");
    }

    function viewJobs(){
        $company_id = $(this).data('company-id');

        $.ajax({
            url: DESTINATION + 'administrator/get_all_jobs/' + $company_id,
            type: 'GET',
            success: (response) => {
                let jobs = JSON.parse(response);

                let component = adminView.generateJobListing(jobs); 
                $(DOM.panel_job_list).html(component);
                $(DOM.panel_job_list + ' table#company-jobs').DataTable({bAutoWidth: false, aaSorting: []});
                $(DOM.modal_view_jobs).modal({show:true});
            }
        });

        
    }

    function saveAdvertisementPosition(){
        let positions = [];

        $('.updated').each(function(){
            positions.push([$(this).attr('data-company-id'),$(this).attr('data-position')]);
            $(this).removeClass('updated');
        });

        $.ajax({
            url: DESTINATION + 'administrator/save_ads',
            type: 'POST',
            data: {
                positions : positions
            },
            success: (response) => {
                console.log(response);
            }
        });
    }

    function clearEditRateModal(){
        $(DOM.modal_edit_body).html("");
    };

    /**
     * Save the Rate Details
     */
    function saveRateDetails(){

        let rateId          = $(DOM.txt_input_id).val();
        let rateDescription = $(DOM.txt_input_description).val();
        let rateMaxPost     = $(DOM.txt_input_max_post).val();
        let ratePricing     = $(DOM.txt_input_pricing).val();

        let status      = adminModel.setRate(rateId, rateDescription, rateMaxPost, ratePricing);
        if(status === 0){
            let rateDetails = adminModel.getRate();
            $.ajax({
                url: DESTINATION + 'rate/save',
                type: 'POST',
                data: rateDetails,
                success: (response) => {
                    let result = JSON.parse(response);
                    if(result === true) {
                        swal({
                            title: 'Success!',
                            text: 'Successfully Updated the rate!',
                            type: 'success',
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        }, () => {
                            window.location.reload();
                        });
                        $(DOM.modal_edit_rates).modal('hide');
                    } else {
                        swal({
                            title: 'Error!',
                            text: 'An Error occured during the update!',
                            type: 'error',
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        });
                    }
                }
            });
        }
    };

    /**
     * Edit Rate Details
     */
    function editRate(){
        
        let rateId = $(this).data('rate-id');

        $.ajax({
            url : DESTINATION + 'rate/get/' + rateId,
            type: 'GET',
            success: (response) => {
                let result = JSON.parse(response);
                let component = adminView.generateEditRateForm(result);
                $(DOM.modal_edit_body).html(component);
                $(DOM.modal_edit_rates).modal({show:true});
            }
        });
    };

    /**
     * Login Method
     * @param {evt} evt 
     */
    function login(evt){
        evt.preventDefault();

        let user = $(DOM.txt_admin_user).val();
        let pass = $(DOM.txt_admin_pass).val();

        let counter = validateLogin(user, pass);
        if(counter === 0){
            $.ajax({
                url: DESTINATION + 'administrator/process_login',
                type: 'POST',
                data: {
                    username: user,
                    password: pass
                },
                success: (response) => {
                    let result = JSON.parse(response);
                    console.log(result);
                    if(result.key === 'error'){
                        swal({
                            title: 'Error!',
                            text: result.message,
                            type: 'error',
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        });
                    } else {
                        window.location.href = DESTINATION + 'administrator'
                    }
                }
            });
        }
    };

    /**
     * Private method for Login Module
     */
    function validateLogin(user, pass){
        let counter = 0;

        if(user === ''){
            new PNotify({
                title: 'Validation Error!',
                text: 'Username field should not be left blank!',
                type: 'error',
                styling: 'bootstrap3'
            });
            counter++;
        }

        if(pass === ''){
            new PNotify({
                title: 'Validation Error!',
                text: 'Password field should not be left blank!',
                type: 'error',
                styling: 'material'
            });
            counter++;
        }

        return counter;
    }

    return {
        /**
         * Initialize all the Event handlers
         */
        init: () => {
            setUpEventListener();
            console.log("Services Started..");
        }
    }

})(AdminModel, AdminView);

/**
 * Load the Application
 */
AdminController.init();