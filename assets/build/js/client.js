/**
 * Author : s4Lv4t0r3
 * Date   : January 13, 2019
 */
var ClientModel = (function(){

    //Complete Client Details
    var Client = function(first_name, last_name, middle_name, 
        address, contact_number, email, prim_educ, 
        sec_educ, ter_educ, course) {
            this.first_name     = first_name;
            this.last_name      = last_name;
            this.middle_name    = middle_name;
            this.address        = address;
            this.contact_number = contact_number;
            this.email          = email;
            this.prim_educ      = prim_educ;
            this.sec_educ       = sec_educ;
            this.ter_educ       = ter_educ;
            this.course         = course
    };

    //Basic Personal Information 
    var PersonalInformation = function(client_id, first_name, last_name, middle_name, 
        address, contact_number, email){
            this.client_id      = client_id;
            this.first_name     = first_name;
            this.last_name      = last_name;
            this.middle_name    = middle_name;
            this.address        = address;
            this.contact_number = contact_number;
            this.email          = email;
    };

    //Educational Attainment Model
    var EducationalAttainment = function(client_id, prim_educ, sec_educ, ter_educ, course){
        this.client_id = client_id
        this.prim_educ = prim_educ;
        this.sec_educ  = sec_educ;
        this.ter_educ  = ter_educ;
        this.course    = course;
    }

    var Qualification = function(aq_id, specialization, fos, educ_attainment){
        this.aq_id           = aq_id;
        this.specialization  = specialization;
        this.fos             = fos;
        this.educ_attainment = educ_attainment;
    };

    let data = {
        id : null,
        client: {},
        counter: 1,
        qualifications: {},
        panel_counter: 0
    };

    let personalInfo = {};

    let educationalAttainment = {};
    
    let qualification_data = {
        aq_id: '',
        qualifications: {}
    };

    validate = function(first_name, last_name, middle_name, 
        address, contact_number, email, prim_educ, 
        sec_educ, ter_educ, course){

        counter = 0;

        var letters = new RegExp("^[a-zA-Z -]*$");
        var numbers = new RegExp("^[0-9]+$"); 
        
        return counter;
    };

    validateEducAttainment = function(client_id, prim_educ, sec_educ, ter_educ, course){
        counter = 0;

        var letters = new RegExp("^[a-zA-Z -]*$");
        var numbers = new RegExp("^[0-9]+$"); 

        if(prim_educ === ''){
            new PNotify({
                title: 'Error!',
                text: 'Primary Education field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });

            counter++;
        }

        if(sec_educ === ''){
            new PNotify({
                title: 'Error!',
                text: 'Secondary Education field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });

            counter++;
        }

        if(ter_educ === ''){
            new PNotify({
                title: 'Error!',
                text: 'Teritiary Education field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });

            counter++;
        }
        
        return counter;
    };

    validateQualification = function(aq_id,specialization, field, degree, work, salary){
        
        let counter = 0;

        if(specialization === '0'){
            new PNotify({
                title: 'Error!',
                text: 'Specialization field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });

            counter++;
        }

        if(field === '0'){
            new PNotify({
                title: 'Error!',
                text: 'Field of Study field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });

            counter++;
        }

        if(degree === '0'){
            new PNotify({
                title: 'Error!',
                text: 'Degree Level field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });

            counter++;
        }

        if(work === '0'){
            new PNotify({
                title: 'Error!',
                text: 'Work Experience field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });

            counter++;
        }

        if(salary === '0'){
            new PNotify({
                title: 'Error!',
                text: 'Expected Salary field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });

            counter++;
        }


        return counter;
    };

    validatePersonalInfo = function(client_id, first_name, last_name, middle_name, 
        address, contact_number, email){
        let counter = 0;

        var letters = new RegExp("^[a-zA-Z -]*$");
        var numbers = new RegExp("^[0-9]+$"); 

        if(first_name === ''){
            new PNotify({
                title: 'Error!',
                text: 'First Name field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        } else if (!first_name.match(letters)){
            new PNotify({
                title: 'Error!',
                text: 'First Name field should only consist of lettes!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        }

        if(last_name === ''){
            new PNotify({
                title: 'Error!',
                text: 'Last Name field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        } else if (!last_name.match(letters)){
            new PNotify({
                title: 'Error!',
                text: 'Last Name field should only consist of lettes!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        }

        if(middle_name === ''){
            new PNotify({
                title: 'Error!',
                text: 'Middle Name field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        } else if (!middle_name.match(letters)){
            new PNotify({
                title: 'Error!',
                text: 'Middle Name field should only consist of lettes!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        }

        if(contact_number === ''){
            new PNotify({
                title: 'Error!',
                text: 'Contact Number field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        } else if (!contact_number.match(numbers)){
            new PNotify({
                title: 'Error!',
                text: 'Contact Number field should only consist of numbers!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;

        } else if (contact_number.length > 11){
            new PNotify({
                title: 'Error!',
                text: 'Contact Number field should not be more than 11 digits!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });

            counter++;

        } else if (contact_number.length < 11){
            new PNotify({
                title: 'Error!',
                text: 'Contact Number field should not be less than 11 digits!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        }
        
        return counter;

    };
    
    return {

        set : function(first_name, last_name, middle_name, 
            address, contact_number, email, prim_educ, 
            sec_educ, ter_educ, course){

            let error_counter = validate(first_name, last_name, middle_name, 
                address, contact_number, email, prim_educ, 
                sec_educ, ter_educ, course);

            if(error_counter == 0) {
                let client;

                client = new Client(first_name, last_name, middle_name, 
                    address, contact_number, email, prim_educ, 
                    sec_educ, ter_educ,course);

                // return client;

                this.assign(client);
            }
        },

        get: () => {
            return data;
        },

        setPersonalInfo: (client_id, first_name, last_name, middle_name, address, contact_number, email) => {
            
            let error_counter = validatePersonalInfo(client_id, first_name, last_name, middle_name, 
                address, contact_number, email);

            if(error_counter === 0){
                personalInfo = new PersonalInformation(client_id, first_name, last_name, middle_name, 
                    address, contact_number, email);
            }

            return error_counter;
        },

        getPersonalInfo: () =>{
            return personalInfo;
        },

        setEducAttainment: (client_id, prim_educ, sec_educ, ter_educ, course) => {
            let error_counter = validateEducAttainment(client_id, prim_educ, sec_educ, ter_educ, course);

            if(error_counter === 0){
                educationalAttainment = new EducationalAttainment(client_id, prim_educ, sec_educ, ter_educ, course);
            }

            return error_counter;
        },

        getEducAttainment: () => {
            return educationalAttainment;
        },

        assign: (client) => {
            data.client = client;
        },

        getCounter: () => {
            return data.counter;
        },

        setCounter: () => {
            data.counter++;
        },

        addQualification: (qualifications) => {
            if(qualifications !== '')
                data.qualifications.push(qualifications);
        },

        setQualification: (aq_id, specialization, fos, educ_attainment) => {
            data.qualifications = new Qualification(aq_id, specialization, fos, educ_attainment);
        },

        getQualifications: () => {
            return data.qualifications;
        },

        resetCounter: () => {
            data.counter = 1
        },

        incrementPanelCounter: () => {
            data.panel_counter++;
        },

        decrementPanelCounter: () => {
            data.panel_counter--;
        },

        getPanelCounter: () => {
            return data.panel_counter;
        },

        setQ: (aq_id, specialization, field, degree, work, salary) => {
            
            let error_counter = validateQualification(aq_id,specialization, field, degree, work, salary);
            if(error_counter === 0) {
                qualification_data.aq_id = aq_id;
           
                qualification_data.qualifications = {
                    specialization : specialization,
                    field: field,
                    degree: degree,
                    work: work,
                    salary: salary
                };
            }
           
            return error_counter;
        },

        getQ: () => {
            return qualification_data;
        }
    };

})();

var ClientView = (function(){

    var DOMStrings = {
        //Form Input Fields
        client_id: 'input#client_id',
        first_name : 'input#first-name',
        last_name : 'input#last-name',
        middle_name: 'input#middle-name',
        address : 'input#address',
        contact_number : 'input#contact-number',
        email : 'input#email',
        prim_educ : 'input#elem-edu',
        sec_educ : 'input#sec-edu',
        ter_educ : 'input#ter-edu',
        course: 'select#course',
        
        saveDetail : 'button#save-details',
        
        //Educational Attainment Panel
        attainment_container: 'div#edit-educational-attainment',
        attainment_header: 'div#educational-attainment-header',
        edit_attainment_btn: 'button#edit-educational-attainment',
        ea_button_container: 'div#attainment-button-container',
        attainment_state: '.ea_disabled',
        ea_footer: 'div#ea_footer',

        //Personal Information Panel
        info_button_container: 'div#info-button-container',
        info_header: 'div#info-header',
        edit_info_btn: 'button#edit-info-btn',
        info_state: '.info_disabled',
        info_footer: 'div#info-footer',
       
        //Qualification Panel
        qualification_panel : 'div#qualification-panel',
        qualification_container: 'div#qualification-box',
        qualification_input: 'input#qualification',
        add_qualification: 'button#add-qualification',
        delete_qualification_component: 'button#delete-qualification-component',
        qualification_modal : 'div#qualification-modal',
        save_qualification: 'button#save-qualifications',
        qualification_modal_body: 'div.modal-content',
        qualification_button: 'button#qualification',
        q_state : '.q_disabled',

        //Applicant Qualification Id
        aq_id                       : 'input#aq_id',

        //Qualification Panel
        qualification_header: 'div#qualification-header',
        q_button_container: 'div#qualification-button-container',
        edit_qualification_btn: 'button#edit-qualification',
        qualification_state: '.q_disabled',
        qualification_footer: 'div#qualification-footer',
        save_qualification_btn : 'button#save-qualification-btn',

        //Qualification Section
        specialization              : 'select#specialization',
        fos                         : 'select#FOS',
        educ_attainment             : 'select#educ-attainment',

        //Changes
        btn_save_info_changes : 'button#save-info-changes',
        btn_save_ea_changes : 'button#save-ea-changes',

        //Panel
        basic_info_panel: 'div#basic-info-panel',
        educ_panel : 'div#educ-panel',
        action_panel: 'div#action-panel',

        //Table
        application_list: 'table#application-list',
        job_listings: 'table#job-listings',

        //Apply Button
        apply_btn: 'button#btn-apply',

        //Additional Qualification
        work_exp : 'select#year-of-exp',
        work_location : 'select#work-location',
        salary        : 'select#salary',


        //Upload
        upload_btn : 'button#upload-btn',
        form_upload: 'form#upload-form',
        upload_panel: 'div#upload-panel',

        //Button to add jobs to Favorites
        btn_favorites: 'button#btn-favorite',
        btn_remove_favorite: 'button#btn-remove-favorite',

        //Job Details Panel
        job_details_panel : 'div#job-details-panel'

    };

    return {
        getDOMStrings: function(){
            return DOMStrings;
        },

        generate_qualification_field: function(count){

            let component  = '<div class="form-group" id=counter-'+ count +'>';
                component += '    <div class="col-md-12 col-sm-12 col-xs-12">';
                component += '        <label for="" class="control-label">Qualification Description: </label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>';
                component += '            <input type="text" id="qualification" name="qualification[]" class="form-control" placeholder="Add new qualification / skills">';
                component += '            <span class="input-group-btn">'
                component += '              <button id="delete-qualification-component" data-counter-id="counter-'+ count +'"class="btn btn-danger btn-block"><i class="fa fa-trash"></i></button>'
                component += '            </span>'
                component += '        </div>';
                component += '    </div>';
                component += '</div>';

            return component;
        },

        reset_qualification_component: () => {

            let component  = '<div class="form-group">';
                component += '    <div class="col-md-12 col-sm-12 col-xs-12">';
                component += '        <label for="" class="control-label">Qualification Description: </label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>';
                component += '            <input type="text" id="qualification" name="qualification[]" class="form-control" placeholder="Add new qualification / skills">';
                component += '        </div>';
                component += '    </div>';
                component += '</div>';

            return component;
        }
    }

})();

var ClientController = (function(clientView, clientModel){

    const DOMStrings = clientView.getDOMStrings();

    /**
     * Setting up Event Handlers
     */
    let setUpEventListener = function(){
        
        $(window).on('load', checkPanelCounter);

        $(DOMStrings.application_list).DataTable({bAutoWidth: false});

        $(DOMStrings.job_listings).DataTable({bAutoWidth: false});
        
        let store                          = $(DOMStrings.saveDetail).on('click', storeDetails);

        let add_qualification              = $(DOMStrings.add_qualification).on('click', addField);

        let delete_qualification_component = $(DOMStrings.qualification_modal).on('click', DOMStrings.delete_qualification_component, removeComponent);

        let close_modal                    = $(DOMStrings.qualification_modal).on('hidden.bs.modal', resetModel);

        let save_qualifications            = $(document).on('submit', 'form#qualification-form', saveQualification);

        let delete_qualification           = $(DOMStrings.qualification_button).on('click', removeQualification);

        let qualification_header_enter     = $(DOMStrings.qualification_header).on('mouseenter', showEditQualification);

        let qualification_header_exit      = $(DOMStrings.qualification_header).on('mouseleave', hideEditQualification);

        let q_edit_button                  = $(DOMStrings.edit_qualification_btn).on('click', enableQPanel);

        //Educational Attainment Events

        let attainment_header_enter        = $(DOMStrings.attainment_header).on('mouseenter', showEditAttainment);

        let attainment_header_exit         = $(DOMStrings.attainment_header).on('mouseleave', hideEditAttainment);

        let attainment_edit_button         = $(DOMStrings.edit_attainment_btn).on('click', enableAttainmentPanel);

        //Personal Information Events

        let info_header_enter              = $(DOMStrings.info_header).on('mouseenter', showEditInfo);

        let info_header_exit               = $(DOMStrings.info_header).on('mouseleave', hideEditInfo);

        let info_edit_button               = $(DOMStrings.edit_info_btn).on('click', enableInfoPanel);
        
        //Separated Save Changes button per panel

        let save_info                      = $(DOMStrings.btn_save_info_changes).on('click', savePersonalInfoChanges);

        let save_educ                      = $(DOMStrings.btn_save_ea_changes).on('click', saveEAChanges);

        let apply                          = $(DOMStrings.apply_btn).on('click', applyToJob);

        let save_qualification_details     = $(DOMStrings.save_qualification_btn).on('click', saveQualificationDetails);   

        // let upload                         = $(DOMStrings.upload_btn).on('click', uploadResume);

        let submit_resume                  = $(document).on('submit', DOMStrings.form_upload, uploadForm);

        let add_favorites                  = $(DOMStrings.btn_favorites).on('click', addToFavorites);

        let remove_favorite                = $(DOMStrings.btn_remove_favorite).on('click', removeToFavorite);
    };
    
    /**
     * Checking {anel Counter Count
     */
    function checkPanelCounter(){
        // setInterval(() => {
        //     let actionPanel = $(DOMStrings.action_panel);
        //     if(clientModel.getPanelCounter() === 3){
        //         actionPanel.removeAttr('hidden');
        //     } 
        // }, 1000);
    };

    /**
     * Qualification Panel - UX
     */
    function showEditQualification(){
        $(DOMStrings.q_button_container).removeAttr('hidden');
    };

    function hideEditQualification(){
        $(DOMStrings.q_button_container).attr('hidden','hidden');
    };

    function enableQPanel(){
         $(DOMStrings.qualification_state).removeAttr('disabled');
         $(DOMStrings.qualification_footer).removeAttr('hidden');
         clientModel.incrementPanelCounter();
    };
    // End of Qualification Panel UX

    /**
     * Educational Attainment Panel - UX
     */
    function showEditAttainment(){
        $(DOMStrings.ea_button_container).removeAttr('hidden');
    };

    function hideEditAttainment(){
        $(DOMStrings.ea_button_container).attr('hidden','hidden');
    };

    function enableAttainmentPanel(){
         $(DOMStrings.attainment_state).removeAttr('disabled');
         $(DOMStrings.ea_footer).removeAttr('hidden');
         clientModel.incrementPanelCounter();
    };
    // End of Qualification Panel UX

    /**
     * Personal Information Panel - UX
     */
    function showEditInfo(){
        $(DOMStrings.info_button_container).removeAttr('hidden');
    };

    function hideEditInfo(){
        $(DOMStrings.info_button_container).attr('hidden','hidden');
    };

    function enableInfoPanel(){
         $(DOMStrings.info_state).removeAttr('disabled');
         $(DOMStrings.info_footer).removeAttr('hidden');
         clientModel.incrementPanelCounter();
    };
    // End of Qualification Panel UX

    // function uploadResume(evt){
    //     evt.preventDefault();
    // }

    function addToFavorites(){
        let applicantId = $(this).data('applicant-id');
        let jobId       = $(this).data('job-id');

        let jobDetails = {
            applicant_id : applicantId,
            job_id      : jobId
        };

        $.ajax({
            url: DESTINATION + 'client/mark_favorite',
            type: 'POST',
            data: jobDetails,
            success: (response) => {
                let result = JSON.parse(response);
                if(result === true){
                    swal({
                        title: 'Success!',
                        text: 'Successfully mark job as favorities!',
                        type: 'success',
                        confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                        confirmButtonText: 'Ok!'
                    }, () => {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "Error!",
                        text: "An error occured saving job as favorite",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                        confirmButtonText: 'Ok!'
                    });
                }
            }
        });
        
    };

    function removeToFavorite(){
        let applicantId = $(this).data('applicant-id');
        let jobId       = $(this).data('job-id');

        let jobDetails = {
            applicant_id : applicantId,
            job_id      : jobId
        };

        $.ajax({
            url: DESTINATION + 'client/remove_favorite',
            type: 'POST',
            data: jobDetails,
            success: (response) => {
                let result = JSON.parse(response);
                if(result === true){
                    swal({
                        title: 'Success!',
                        text: 'Successfully remove job as favorities!',
                        type: 'success',
                        confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                        confirmButtonText: 'Ok!'
                    }, () => {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "Error!",
                        text: "An error occured removing the job as favorite",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                        confirmButtonText: 'Ok!'
                    });
                }
            }
        });
    }

    function uploadForm(evt){
        evt.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: DESTINATION + 'client/upload',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (response) => {
                let data = JSON.parse(response);
                if(data.key === 'error'){
                    alert(data.message);
                } else {
                    swal({
                        title: 'Success!',
                        text: 'Successfully updated your resume!',
                        type: 'success',
                        confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                        confirmButtonText: 'Ok!'
                    });
                    
                    // $(DOMStrings.upload_panel).load();
                    window.location.reload();
                }
            }
        });
    }

    function storeDetails(){

        let first_name      = $(DOMStrings.first_name).val();
        let last_name       = $(DOMStrings.last_name).val();
        let middle_name     = $(DOMStrings.middle_name).val();
        let address         = $(DOMStrings.address).val();
        let contact_number  = $(DOMStrings.contact_number).val();
        let email           = $(DOMStrings.email).val();
        let prim_educ       = $(DOMStrings.prim_educ).val();
        let sec_educ        = $(DOMStrings.sec_educ).val();
        let ter_educ        = $(DOMStrings.ter_educ).val();
        let course          = $(DOMStrings.course).val();
        
        let client = clientModel.set(first_name, last_name, middle_name,
            address, contact_number, email, prim_educ, 
            sec_educ, ter_educ,course); 
        
        recordData();
    };

    function recordData(){
        var client_data = clientModel.get().client;
        $.ajax({
            url: DESTINATION + 'client/record',
            type: 'POST',
            data: client_data,
            success: function(response){
                let result = JSON.parse(response);
                if(result === true){
                    swal({
                        title: "Success!",
                        text: "Successfully Updated your Profile Information",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                        confirmButtonText: 'Success!'
                    }, function(){
                        // window.location.reload();
                    });
                } else {
                    swal({
                        title: "Error!",
                        text: "An Error Occured, Dont leave any fields blank",
                        type: "error"
                    });
                } 
            }
        });
    };

    /**
     * Saving Changes done to each Basic Profile Information
     */
    function savePersonalInfoChanges(){
        let client_id       = $(DOMStrings.client_id).val(); 
        let first_name      = $(DOMStrings.first_name).val();
        let last_name       = $(DOMStrings.last_name).val();
        let middle_name     = $(DOMStrings.middle_name).val();
        let address         = $(DOMStrings.address).val();
        let contact_number  = $(DOMStrings.contact_number).val();
        let email           = $(DOMStrings.email).val();

        let counter = clientModel.setPersonalInfo(client_id, first_name, last_name, middle_name, 
            address, contact_number, email);
        if(counter === 0) {
            let personalInfo = clientModel.getPersonalInfo();
            //TODO:
            $.ajax({
                url: DESTINATION + 'client/update_personal_info',
                type: 'POST',
                data: personalInfo,
                success: function(response){
                    let result = JSON.parse(response);
                    if(result === true){
                        swal({
                            title: 'Success!',
                            text: 'Successfully updated your Personal Information!',
                            type: 'success',
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        });
    
                        $(DOMStrings.basic_info_panel).load();
    
                        $(DOMStrings.info_state).attr('disabled','disabled');
                        $(DOMStrings.info_footer).attr('hidden','hidden');
    
                        clientModel.decrementPanelCounter();
                    } else {
                        swal({
                            title: 'Error!',
                            text: 'An error occured in updating your Personal Information!',
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
     * Saving Changes do to Educational Attainment Section
     */
    function saveEAChanges(){

        let client_id       = $(DOMStrings.client_id).val(); 
        let prim_educ       = $(DOMStrings.prim_educ).val();
        let sec_educ        = $(DOMStrings.sec_educ).val();
        let ter_educ        = $(DOMStrings.ter_educ).val();
        let course          = $(DOMStrings.course).val();

        let counter = clientModel.setEducAttainment(client_id, prim_educ, sec_educ, ter_educ, course);
        
        if(counter === 0) {
            let ea = clientModel.getEducAttainment();
            $.ajax({
                url: DESTINATION + 'client/update-ea',
                type: 'POST',
                data: ea,
                success: (response) => {
                    let result = JSON.parse(response);
                    if(result === true){
                        
                        swal({
                            title: 'Success!',
                            text: 'Succefully updated your Educational Attainment',
                            type: 'success',
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        });
    
                        $(DOMStrings.educ_panel).load();
    
                        $(DOMStrings.attainment_state).attr('disabled','disabled');
                        $(DOMStrings.ea_footer).attr('hidden','hidden');
    
                        clientModel.decrementPanelCounter();
    
                    } else {
                        swal({
                            title: 'Error!',
                            text: 'Error updating your Educational Attainment',
                            type: 'error',
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        });
                    }
                }
            });
        }
    };

    function applyToJob(){
        
        let _jobId       = $(this).data('job-id');
        let _applicantId = $(this).data('applicant-id');
        
        let applicationData = {
            applicantId : _applicantId,
            jobId       : _jobId
        };
        
        $.ajax({
            url: DESTINATION + 'job/is_already_applied',
            type: 'POST',
            data: applicationData,
            success: (response) => {
                let result = JSON.parse(response);
                if(result === false){
                    $.ajax({
                        url: DESTINATION + 'client/apply',
                        type: 'POST',
                        data: applicationData,
                        success: (result) => {
                            let status = JSON.parse(result);
                            if(status === true){
                                swal({
                                    title: 'Success!',
                                    text: 'Tou have been succefully applied to the position!',
                                    type: 'success',
                                    confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                                    confirmButtonText: 'Ok!'
                                }, function(){
                                    window.location.href = DESTINATION + 'client/search';
                                });
                            } else {
                                swal({
                                    title: 'Error!',
                                    text: 'Cannot process your application!',
                                    type: 'error',
                                    confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                                    confirmButtonText: 'Ok!'
                                });
                            }
                        }
                    });
                }
            }
        });
    }
    
    function removeQualification(){
        // alert($(this).data('qualification-id'));
    };

    function addField(event){
        let component = clientView.generate_qualification_field(clientModel.getCounter());
        $(DOMStrings.qualification_container).append(component);
        clientModel.setCounter();
        event.preventDefault();
    };

    function saveQualification(event){
        event.preventDefault()

        var formData = $(this).serializeArray();

        formData.forEach((value) =>{
            clientModel.addQualification(value.value);
        });

        $(DOMStrings.qualification_modal).modal('hide');
    };


    /**
     *  Save Qualification database transaction
     */
    function saveQualificationDetails(){

        let aq_id           = $(DOMStrings.aq_id).val();
        let specialization  = $(DOMStrings.specialization).val();
        let fos             = $(DOMStrings.fos).val();
        let educ_attainment = $(DOMStrings.educ_attainment).val();

        let work            = $(DOMStrings.work_exp).val();
        // let location        = $(DOMStrings.work_location).val();
        let salary          = $(DOMStrings.salary).val();

        // console.log([work, location, salary]);
        // clientModel.setQualification(aq_id, specialization, fos, educ_attainment);
        // console.log(clientModel.getQualifications());

        // let counter = clientModel.setQ(aq_id, specialization, fos, educ_attainment);
        let counter = clientModel.setQ(aq_id, specialization, fos, educ_attainment, work, salary);
        // console.log(clientModel.getQ());
        // let qualifications = clientModel.getQualifications();

        if(counter === 0){
            let qualifications = clientModel.getQ();
        
            if(aq_id === ""){
                $.ajax({
                    url: DESTINATION + 'client/add_qualification',
                    type: 'POST',   
                    data: qualifications,
                    async: false,
                    success: (response) => {
                        let result = JSON.parse(response);
                        if(result === true){
                            swal({
                                title: 'Success!',
                                text: 'Successfully added qualification details!',
                                type: 'success',
                                confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                                confirmButtonText: 'Ok!'
                            }, () => {
                                // window.location.reload()
                                $(DOMStrings.qualification_panel).load();
    
                                $(DOMStrings.q_state).attr('disabled','disabled');
                                $(DOMStrings.qualification_footer).attr('hidden','hidden');
                            });
    
                        } else {
    
                            swal({
                                title: 'Error!',
                                text: 'An error occured in adding qualification details!',
                                type: 'error',
                                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                                confirmButtonText: 'Ok!'
                            });
    
                        }
                    }
                });
            } else {
                $.ajax({
                    url: DESTINATION + 'client/update_qualifications',
                    type: 'POST',
                    data: qualifications,
                    success: (response) => {
                        let result = JSON.parse(response);
                        if(result === true){
                            swal({
                                title: 'Success!',
                                text: 'Successfully updated your qualification details!',
                                type: 'success',
                                confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                                confirmButtonText: 'Ok!'
                            });
    
                            $(DOMStrings.qualification_panel).load();
    
                            $(DOMStrings.q_state).attr('disabled','disabled');
                            $(DOMStrings.qualification_footer).attr('hidden','hidden');
                        } else {
                            swal({
                                title: 'Error!',
                                text: 'An error occured in updating qualification details!',
                                type: 'error',
                                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                                confirmButtonText: 'Ok!'
                            });
                        }
                    }
                });
            }
        }
    };

    function removeComponent(event){
        let component_id = $(this).data('counter-id');
        $('div#' + component_id).remove();
        event.preventDefault();
    };

    function show_action(){
        alert("hovered");
    };

    function resetModel(event){   
        event.preventDefault();
        let component = clientView.reset_qualification_component();
        $(DOMStrings.qualification_modal +' '+ DOMStrings.qualification_modal_body +' '+ DOMStrings.qualification_container).html(component);
    };

    return {
        init: () => {
            setUpEventListener();
            console.log("Process Initialized.");
        },
        objectGet: () => {
            return clientModel.get();
        },
        
    };

})(ClientView, ClientModel);

ClientController.init();
