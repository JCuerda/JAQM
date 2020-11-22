/**
 * Create by S4Lv4t0R3
 * Date: January 13, 2019
 */
var companyModel = (function(){
    
    //Job Model
    let Job = (id, position, description) => {
        this.id = id;
        this.position        = position;
        this.description     = description;

    };

    let Qualification = (specialization, field, degree) =>{
        this.specialization = specialization;
        this.field = field;
        this.degree = degree;
    }

    //Company Model
    let Company = function(id, name, address, contact, description){
        this.id          = id;
        this.name        = name;
        this.address     = address;
        this.contact     = contact;
        this.description = description;
    };

    let data = {
        postedJob: {
            position: '',
            qualifications: {},
            description: '',
            work_exp : '',
            salary : ''
        },

        job: {
            id: '',
            position: '',
            qualifications: {},
            description: ''
        },

        company: {}
    };

    //Validation Method - Job Posting
    function validateJobPosted(position, description, specialization, field, degree, work_exp, salary){
        let counter = 0;

        if(position === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Position field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(description === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Description field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(specialization == 0){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Specialization field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(field == 0){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Field of Study field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(degree == 0){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Degree Level field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(work_exp == 0){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Work Experience field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(salary == 0){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Salary Range field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        return counter;
    }
    
    //Validation Method - Company Profile
    function validateCompanyProfile(id, name, address, contact, description){
        let counter = 0;
        let numbers = new RegExp("^[0-9]+$"); 

        if(id === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Id field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(name === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Name field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(address === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Address field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(contact === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Contact Number field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        } else if(!contact.match(numbers)){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Contact Number field should only consist of numbers',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(description === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Description field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        return counter;
    }

    //Validation Method - Edit Job
    function editJobValidation(id, position, description, specialization, field, degree){
        let counter = 0;

        if(id === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Id field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(position === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Position field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(description === ''){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Description field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(specialization == 0){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Specialization field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(field == 0){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Field of Study field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        if(degree == 0){
            new PNotify({
                title: 'An Error Occured!',
                text: 'Degree Level field should not be left blank',
                type: 'error',
                styling: 'bootstrap3',
                hidden: false
            });
            counter++;
        }

        return counter;
    }

    return {

        setJob: (id, position, description, specialization, field, degree, work, salary) => {
            let error_counter = editJobValidation(id, position, description, specialization, field, degree, work, salary)
            
            if(error_counter === 0){
                data.job.id = id;

                data.job.position = position;
                
                data.job.qualifications = {
                    specialization: specialization,
                    field: field,
                    degree: degree,
                    work: work,
                    salary: salary
                };

                data.job.description = description;
            }

            return error_counter;
        },

        getJob: () => {
            return data.job;
        },

        setPostedJob: (position, description, specialization, field, degree, work_exp, salary) => {

            let error_counter = validateJobPosted(position, description, specialization, field, degree, work_exp, salary);
            if(error_counter === 0){
                data.postedJob.position = position;
            
                data.postedJob.qualifications = {
                    specialization: specialization,
                    field: field,
                    degree: degree,
                    work : work_exp,
                    salary : salary
                };

                data.postedJob.description = description;
            }

            return error_counter;
        },

        getPostedJob: () => {
            return data.postedJob;
        },

        setCompany: (id, name, address, contact, description) => {
            let error_counter = validateCompanyProfile(id, name, address, contact, description);
            
            if(error_counter === 0){
                data.Company = new Company(id, name, address, contact, description);
            }

            return error_counter;
        },

        getCompany: () => {
            return data.Company;
        }
    };

})();

var companyView = (function(){
    
    let DOMStrings = {
        
        company_name                : 'input#company-name', 
        company_address             : 'input#address', 
        company_contact             : 'input#contact-number', 
        company_id                  : 'input#company-id',

        //button
        btn_save_company_profile    : 'button#save-company-profile-changes',
        btn_post_job                : 'button#post-job',
        btn_save_edit_post_job      : 'button#save-edit-post-job',
        btn_edit_job_post           : 'button#edit-job',

        //Text Area Wysiwyg
        job_description_txtArea     : 'textarea#job-description',
        company_description_txtArea :'textarea#company-description',
        edit_job_description_txtArea: 'textarea#edit-job-description',

        //Create 
        job_position                : 'input#job-position',
        specialization              : 'select#specialization',
        fos                         : 'select#FOS',
        educ_attainment             : 'select#educ-attainment',
        work_exp                    : 'select#year-of-exp',
        salary                      : 'select#salary',

        //Edit
        edit_job_position           : 'input#edit-job-position',
        edit_specialization         : 'select#edit-specialization',
        edit_fos                    : 'select#edit-FOS',
        edit_educ_attainment        : 'select#edit-educ-attainment',
        edit_work_exp               : 'select#edit-year-of-exp',
        edit_salary                 : 'select#edit-salary',

        //DataTable
        tbl_applicant_list          : 'table#applicants-list',
        tbl_job_lists               : 'table#job-list',

        edit_job_body               : 'div#edit-job-body',
        job_id                      : 'input#job-id',

        //Modal
        edit_job_modal              : 'div#edit-posted-job',

        //Panel Job List
        job_list_panel              : 'div#job-list-table',

        //Applicant Marker UI
        shortlist_btn               : 'button#shortlist-applicant',
        interview_btn               : 'button#interview-applicant',

        //Upload Logo
        btn_upload_logo             : 'button#upload-logo-btn',
        frm_logo                    : 'form#upload-logo-form',

        //Delete Job Button
        btn_delete                  : 'button#delete-job'
    };

    return {
        getDOMStrings: () => {
            return DOMStrings;
        },

        generateEditJobForm: (jobData) => {
            let component  = '<div class="form-group">';
                component += '    <div class="col-md-12 col-sm-12 col-xs-12">';
                component += '        <label for="" class="control-label">Job Position</label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>';
                component += '            <input type="hidden" id="job-id" name="job_id" class="form-control "  placeholder="" value="'+ jobData['job'].id +'">';
                component += '            <input type="text" id="edit-job-position" name="job_position" class="form-control "  placeholder="" value="'+ jobData['job'].title +'">';
                component += '        </div>';
                component += '    </div>';
                component += '</div><!-- form-group -->';
                component += '<div class="form-group">';
                component += '    <div class="col-md-4 col-sm-12 col-xs-12 m-t-10">';
                component += '        <label for="" class="control-label">Specialization </label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-cogs"></i></span>';
                component += '            <select class="form-control select2" id="edit-specialization" name="specialization" placeholder="" value="">';
                                            jobData['specialization'].forEach(spec => {
                component += '                    <optgroup label="'+ spec.description +'">';
                                                        jobData['sub_specialization'].forEach( sub => {
                                                            if(spec.id === sub.specialization_id){
                                                                if(jobData['job'].qualifications['Specialization'] === sub.id){
                component += '                                      <option value="'+ sub.id +'" selected>'+ sub.description +'</option>';
                                                                } else {
                component += '                                      <option value="'+ sub.id +'">'+ sub.description +'</option>';
                                                                }
                                                            }
                                                        });
                component += '                    </optgroup>';
                                            });
                component += '            </select>';
                component += '        </div>';
                component += '    </div>';
                component += '    <div class="col-md-4 col-sm-12 col-xs-12 m-t-10">';
                component += '        <label for="" class="control-label">Field of Study</label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-book"></i></span>';
                component += '            <select class="form-control select2" id="edit-FOS" name="fos" placeholder="" value="">';
                                            jobData['fos'].forEach(f => {
                                                if(jobData['job'].qualifications['Field of Study'] === f.id){
                component += '                      <option value="'+ f.id +'" selected>'+ f.description +'</option>';
                                                } else {
                component += '                      <option value="'+ f.id +'">'+ f.description +'</option>';
                                                }
                                            });
                component += '            </select>';
                component += '        </div>';
                component += '    </div>';
                component += '    <div class="col-md-4 col-sm-12 col-xs-12 m-t-10">';
                component += '        <label for="" class="control-label">Educational Attainment</label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>';
                component += '            <select class="form-control select2" id="edit-educ-attainment" name="educ_attainment" placeholder="" value="">';

                                                jobData['eas'].forEach(e => {
                                                    if(jobData['job'].qualifications['Degree Level'] === e.id){
                component += '                          <option value="'+ e.id +'" selected>'+ e.description +'</option>';
                                                    } else {
                component += '                          <option value="'+ e.id +'" >'+ e.description +'</option>';
                                                    }
                                                });
                component += '            </select>';
                component += '        </div>';
                component += '    </div>';

                component += '<div class="form-group">';
                component += '    <div class="col-md-6 col-sm-12 col-xs-12 m-t-10">';
                component += '        <label for="" class="control-label">Work Experience </label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
                component += '            <select class="form-control select2"  id="edit-year-of-exp" name="year_of_exp" placeholder="" value="">';
                                            jobData['work_exps'].forEach(e => {
                                                if(jobData['job'].qualifications['Work Experience'] === e.id){
                component += '                      <option value="'+ e.id +'" selected>'+ e.description +'</option>';
                                                } else {
                component += '                      <option value="'+ e.id +'" >'+ e.description +'</option>';
                                                }
                                            });
                component += '            </select>';
                component += '        </div>';
                component += '    </div>';
                component += '</div>';

              
                component += '<div class="form-group">';
                component += '    <div class="col-md-6 col-sm-12 col-xs-12 m-t-10">';
                component += '        <label for="" class="control-label">Work Experience </label>';
                component += '        <div class="input-group">';
                component += '            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
                component += '            <select class="form-control select2"  id="edit-year-of-exp" name="year_of_exp" placeholder="" value="">';
                                            jobData['salaries'].forEach(e => {
                                                if(jobData['job'].qualifications['Salary'] === e.id){
                component += '                      <option value="'+ e.id +'" selected>'+ e.from +' - '+ e.to +'</option>';
                                                } else {
                component += '                      <option value="'+ e.id +'" >'+ e.from +' - '+ e.to +'</option>';
                                                }
                                            });
                component += '            </select>';
                component += '        </div>';
                component += '    </div>';
                component += '</div>';


                component += '    <div class="col-md-12 m-t-10">';
                component += '        <label for="" class="control-label">Job Description </label>';
                component += '        <textarea class="form-control" id="edit-job-description" name="job_description">'+ jobData.job.description +'</textarea>';
                component += '    </div>';
                component += '</div><!-- form-group -->';

                return component;
        }
    };

})();


var companyController = (function(cModel, cView){

    let DOMStrings = cView.getDOMStrings();
     
    let setupEventListener = function(){

        $(window).on('load', initInnerComponent);

        $(DOMStrings.tbl_applicant_list).DataTable({ bAutoWidth: false });

        let job_list          = $(DOMStrings.tbl_job_lists).DataTable({ bAutoWidth: false });

        let post              = $(DOMStrings.btn_post_job).on('click', postJob);

        let save_comp_profile = $(DOMStrings.btn_save_company_profile).on('click', saveCompProfile);

        let save_editted_job  = $(DOMStrings.btn_save_edit_post_job).on('click', saveEdittedJob); 

        // let edit_job          = $(DOMStrings.btn_edit_job_post).on('click', editJobDetails);

        let edit_job          = $(DOMStrings.tbl_job_lists).on('click', DOMStrings.btn_edit_job_post ,editJobDetails);

        let hide_edit_modal   = $(DOMStrings.edit_job_modal).on('hidden.bs.modal', clearEditModal);

        let shortlist         = $(DOMStrings.tbl_applicant_list).on('click', DOMStrings.shortlist_btn ,shortListApplicant);

        let interview         = $(DOMStrings.tbl_applicant_list).on('click', DOMStrings.interview_btn, interviewApplicant);

        let upload_logo       = $(document).on('submit',DOMStrings.frm_logo, uploadCompanyLogo);

        let delete_job        = $(DOMStrings.btn_delete).on('click', deleteJob);

        if($('button#process-subscription-1').length){

            ['button#process-subscription-1', 'button#process-subscription-2', 'button#process-subscription-3' ].forEach(function(selector){
                paypal.Button.render({
                    env: 'sandbox',
                    client: {
                        sandbox: 'AWBxbRLPD6mhxNWay91PJIZJHPM_ClkU6MLrt1TnsVhr8UvJhyQTL_5XwSXDU0uJYEEY1uePpqt5g96Y'
                    },
                    style: {
                        color: 'gold',   // 'gold, 'blue', 'silver', 'black'
                        size:  'medium', // 'medium', 'small', 'large', 'responsive'
                        shape: 'rect',    // 'rect', 'pill'
                        label: 'pay'
                    },
                    payment: function (data, actions) {
                        return actions.payment.create({
                            transactions: [{
                                amount: {
                                    // total: window.sessionStorage.getItem('price'),
                                    total: $(selector).data('rate-price'),
                                    currency: 'USD'
                                }
                            }]
                        });
                    },
                    onAuthorize: function (data, actions) {
                        return actions.payment.execute()
                            .then(function () {
                                let company_id = $(selector).data('company-id');
                                let rate_id = $(selector).data('rate-type');
                                updateSubscriptionType(company_id, rate_id);
                            });
                    }
                }, selector);
            });
        }
    };

    function deleteJob(){

        swal({
            title: "Are you sure ?",
            text: "Do you want to remove this job from your company listings?",
            type: "error",
            showCancelButton: true,
            cancelButtonClass: 'btn-default btn-md waves-effect',
            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
            confirmButtonText: 'Proceed'
        }, () => {
            let j_id    = $(this).data('job-id');
            let job_id     = $(this).data('job');
            let company = $(this).data('company-id');
            $.ajax({
                url: DESTINATION + 'company/delete',
                type: 'POST',
                data: {
                    jq_id: j_id,
                    job_id: job_id,
                    company_id: company
                },
                success: (response) => {
                    let data = JSON.parse(response);
    
                    if(data.key === 'error'){
                        swal({
                            title: "Error!",
                            text: data.message,
                            type: "error",
                            showCancelButton: false,
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        });
                    } else {
                        swal({
                            title: "Success!",
                            text: 'Successfully Removed the job from your job listings!',
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        }, () => {
                            window.location.reload();
                        });
                    }
                }
            });
        });
    }

    function updateSubscriptionType(company_id, rate_id){
        let subscription = {
            company_id : company_id,
            rate_id : rate_id
        }

        $.ajax({
            url: DESTINATION + 'company/subscribe',
            type: 'POST',
            data: subscription,
            success: (response) => {
                let data = JSON.parse(response);
                if(data.key === 'error'){
                    swal({
                        title: "Error!",
                        text: data.message,
                        type: "error",
                        showCancelButton: false,
                        confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                        confirmButtonText: 'Ok!'
                    });
                } else {
                    swal({
                        title: "Success!",
                        text: "Successfully subscribe to JAQM! You can now post job offers for your company!",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                        confirmButtonText: 'Proceed!'
                    }, () => {
                        window.location.href = DESTINATION + 'company/post';
                    });
                }
            }
        });
    }

    function initInnerComponent(){

        if($(DOMStrings.job_description_txtArea).length > 0) {
            tinymce.init({
                selector: $(DOMStrings.job_description_txtArea).selector,
                theme: "modern",
                height:300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }

        if($(DOMStrings.company_description_txtArea).length > 0) {
            tinymce.init({
                selector: $(DOMStrings.company_description_txtArea).selector,
                theme: "modern",
                height:300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }

        if($(DOMStrings.edit_job_description_txtArea).length > 0) {
            tinymce.init({
                selector: $(DOMStrings.edit_job_description_txtArea).selector,
                theme: "modern",
                height:300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }

    };

    function initEditJobTextArea(){
        if($(DOMStrings.edit_job_description_txtArea).length > 0) {
            tinymce.init({
                selector: $(DOMStrings.edit_job_description_txtArea).selector,
                theme: "modern",
                height:300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }
    };

    function shortListApplicant(){
        swal({
            title: "Are you sure ?",
            text: "Proceed shortlisting the applicant?",
            type: "info",
            showCancelButton: true,
            cancelButtonClass: 'btn-default btn-md waves-effect',
            confirmButtonClass: 'btn-info btn-md waves-effect waves-light',
            confirmButtonText: 'Proceed'
        }, () => {
            let id = $(this).data('applicant-id');
            $.ajax({
                url: DESTINATION + 'company/mark_as_shortlisted',
                type: 'POST',
                data: { applicant_id : id },
                success: (response) => {
                    let result = JSON.parse(response);
                    if(result === true){
                        swal({
                            title: "Success!",
                            text: "Successfully update applicant status!",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Success!'
                        }, () => {
                            window.location.reload();
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: "An Error Occured updating applicant's status",
                            type: "error"
                        });
                    }
                }
            });
        });

    };

    function interviewApplicant(e){
        e.preventDefault();
        swal({
            title: "Are you sure ?",
            text: "Proceed marking applicant for interview?",
            type: "info",
            showCancelButton: true,
            cancelButtonClass: 'btn-default btn-md waves-effect',
            confirmButtonClass: 'btn-info btn-md waves-effect waves-light',
            confirmButtonText: 'Proceed'
        }, () => {
            let id = $(this).data('applicant-id');

            $.ajax({
                url: DESTINATION + 'company/mark_as_interview',
                type: 'POST',
                data: { applicant_id : id },
                success: (response) => {
                    let result = JSON.parse(response);
                    if(result === true){
                        swal({
                            title: "Success!",
                            text: "Successfully update applicant status!",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Success!'
                        }, () => {
                            window.location.reload();
                        });
                        
                    } else {
                        swal({
                            title: "Error!",
                            text: "An Error Occured updating applicant's status",
                            type: "error"
                        });
                    }
                }
            });
        });
    };

    function clearEditModal(){
        $(DOMStrings.edit_job_body).html("");
    };

    function editJobDetails(){

        let $jq_id = $(this).data('job-id');

        $.ajax({
            url: DESTINATION + 'job/get_job_details/' + $jq_id,
            type: 'GET',
            success: (response) => {
                let data = JSON.parse(response);
                let component = cView.generateEditJobForm(data);

                $(DOMStrings.edit_job_body).html(component);
                tinymce.remove();
                initEditJobTextArea();
                $(DOMStrings.edit_job_modal).modal({show: true});
            }
        });
    }

    //Post Job 
    function postJob(){

        let jobDescription  = tinymce.activeEditor.getContent({format: 'raw'}); 
        let jobPosition     = $(DOMStrings.job_position).val();
        let specialization  = $(DOMStrings.specialization).val();
        let fos             = $(DOMStrings.fos).val();
        let educ_attainment = $(DOMStrings.educ_attainment).val();

        let work_exp        = $(DOMStrings.work_exp).val();
        let salary          = $(DOMStrings.salary).val();
//TODO:
        // let status = cModel.setPostedJob(jobPosition, jobDescription, specialization, fos, educ_attainment);
        let status = cModel.setPostedJob(jobPosition, jobDescription, specialization, fos, educ_attainment, work_exp, salary);
        if(status === 0){
            let job = cModel.getPostedJob();

            $.ajax({
                url: DESTINATION + 'company/save_job_post',
                type: 'POST',
                data: job,
                success: (response) => {
                    let result = JSON.parse(response);
                    if(result === true){
                        swal({
                            title: "Success!",
                            text: "Successfully Posted new job!",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Success!'
                        }, () => {
                            window.location.href = DESTINATION + 'company/job_listing'
                        });
    
                    } else if(result.key === 'error'){
                        swal({
                            title: "Error!",
                            text:  result.message,
                            type: "error",
                            showCancelButton: false,
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Ok!'
                        });
                    } else if(result.key === 'subs_error'){
                        swal({
                            title: "Error!",
                            text: result.message,
                            type: "error",
                            showCancelButton: false,
                            confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                            confirmButtonText: 'Proceed!'
                        },() => {
                            window.location.href = DESTINATION + 'company/pricing'
                        });
                    }
                }
            });
        }
    };

    /**
     * Save or Update Company Profile
     */
    function saveCompProfile(){
        let companyId          = $(DOMStrings.company_id).val();
        let companyName        = $(DOMStrings.company_name).val();
        let companyAddress     = $(DOMStrings.company_address).val();
        let companyContact     = $(DOMStrings.company_contact).val();
        let companyDescription = tinymce.activeEditor.getContent({format: 'raw'});

        let status = cModel.setCompany(companyId,companyName, companyAddress, companyContact, companyDescription);
        if(status === 0){
            let company = cModel.getCompany();
            if(companyId !== ''){
                $.ajax({
                    url: DESTINATION + 'company/update_profile',
                    type: 'POST',
                    data: company,
                    success: (response) => {
                        let result = JSON.parse(response);
                        if(result === true){
                            swal({
                                title: "Success!",
                                text: "Successfully updated company details!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                                confirmButtonText: 'Success!'
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: "An error occured during updating company details!",
                                type: "error",
                                showCancelButton: false,
                                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                                confirmButtonText: 'Error!'
                            });
                        }
                    }
                });
            } else {
                $.ajax({
                    url: DESTINATION + 'company/add_profile',
                    type: 'POST',
                    data: company,
                    success: (response) => {
                        let result = JSON.parse(response);
    
                        if(result === true){
                            swal({
                                title: "Error!",
                                text: "Successfully added new company details!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                                confirmButtonText: 'Success!'
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: "An error occured during updating company details!",
                                type: "error",
                                showCancelButton: false,
                                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
                                confirmButtonText: 'Error!'
                            });
                        }
                    }
                });
            }
        }
    };

    /**
     * Save Editted Job
     */
    function saveEdittedJob(){

        let newPostion        = $(DOMStrings.edit_job_position).val();
        let newSpecialization = $(DOMStrings.edit_specialization).val();
        let newFOS            = $(DOMStrings.edit_fos).val();
        let newEducAttainment = $(DOMStrings.edit_educ_attainment).val();
        let newDescription    = tinymce.activeEditor.getContent({format: 'raw'});

        let newWork           = $(DOMStrings.edit_work_exp).val();
        let newSalary         = $(DOMStrings.edit_salary).val();

        let jobId             = $(DOMStrings.job_id).val();

        let status = cModel.setJob(jobId, newPostion, newDescription, newSpecialization, newFOS, newEducAttainment, newWork, newSalary);
        
        if(status === 0){
            let job = cModel.getJob();

            $.ajax({
                url: DESTINATION + 'company/update_job',
                type: 'POST',
                data: job,
                success: (response) => {
                    if(response === 'true'){
                        swal({
                            title: "Success!",
                            text: "Successfully Updated your Job Details",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                            confirmButtonText: 'Success!'
                        });
    
                        $(DOMStrings.edit_job_modal).modal('hide');
                        window.location.reload();
                    } else {
                        swal({
                            title: "Error!",
                            text: "An Error Occured updating job details",
                            type: "error"
                        });
                    }
                }
            });
        }
    }

    /**
     * Upload Company Logo
     */
    function uploadCompanyLogo(evt){
        evt.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: DESTINATION + 'company/process_logo',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (response) => {
                let data = JSON.parse(response);
                console.log(data);
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
                    window.location.reload();
                }
            }
        });
    }

    return {
        init: () => {
            setupEventListener();
            console.log("Service Started..");
        }
    };

})(companyModel, companyView);

companyController.init();