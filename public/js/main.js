
function extraDateFiled(index){
    let extraDateFiled = '<div id="extra_filed_'+index+'"><small class="text-center d-block mb-2">-- to --</small><input required type="date" name="logic_2nd_value_'+index+'" class="form-control" placeholder="date"></div>'
    return extraDateFiled;
}
function dateLogicFields(index){
    let data = '<div class="form-row pb-4 segment-logic">' +
        '<input required hidden type="number" name="target_value[]" value="'+index+'">' +
        '<input required hidden type="text" name="action_type_'+index+'" value="date">' +
        '<div class="col-lg-3 col-sm-6 pb-2">' +
        '<select required name="action_column_'+index+'" class="form-control">' +
        '<option value="" selected>Select Field</option>' +
        '<option value="created_at">Created at</option>' +
        '<option value="birth_day">Birth Day</option>' +
        '<option value="updated_at">Updated at</option>' +
        '</select>' +
        '</div>' +
        '<div class="col-lg-3 col-sm-6 pb-2">' +
        '<select required name="logic_type_'+index+'" class="form-control date-pick-logic" data-target="'+index+'">' +
        '<option value="" selected>Select Logic</option>' +
        '<option value="before">Before</option>' +
        '<option value="on">On</option>' +
        '<option value="after">After</option>' +
        '<option value="on_or_before">On or before</option>' +
        '<option value="on_or_after">On or after</option>' +
        '<option value="between">Between</option>' +
        '</select>' +
        '</div>' +
        '<div class="col-lg-3 col-sm-6 pb-2" id="date_pick_value_'+index+'">' +
        '<input required name="logic_value_'+index+'" type="date" class="form-control" placeholder="date">' +
        '</div>' +
        '<div class="col-8 col-lg-2 col-sm-4 pb-2">' +
        '<select required name="logic_operator_'+index+'" class="form-control">' +
        '<option value="and" selected>And</option>' +
        '<option value="or">Or</option>' +
        '</select>' +
        '</div>' +
        '<div class="col-4 col-lg-1 col-sm-2 pb-2">' +
        '<button type="button" class="btn btn-outline-dark close_btn"><i class="fas fa-times"></i></button>' +
        '</div>' +
        '</div>';
    return data;
}
function textLogicFields(index){
    let data = '<div class="form-row pb-4 segment-logic">' +
        '<input required hidden type="number" name="target_value[]" value="'+index+'">' +
        '<input required hidden type="text" name="action_type_'+index+'" value="text">' +
        '<div class="col-lg-3 col-sm-6 pb-2">' +
        '<select required name="action_column_'+index+'" class="form-control">' +
        '<option value="" selected>Select Field</option>' +
        '<option value="first_name">First Name</option>' +
        '<option value="last_name">Last Name</option>' +
        '<option value="email">Email</option>' +
        '</select>' +
        '</div>' +
        '<div class="col-lg-3 col-sm-6 pb-2">' +
        '<select required name="logic_type_'+index+'" class="form-control" data-target="'+index+'">' +
        '<option value="" selected>Select Logic</option>' +
        '<option value="is">Is</option>' +
        '<option value="is_not">is not</option>' +
        '<option value="starts_with">Starts with</option>' +
        '<option value="ends_with">Ends with</option>' +
        '<option value="contains">Contains</option>' +
        '<option value="doesnot_starts_with">Doesnot starts with</option>' +
        '<option value="doesnot_end_with">Doesnot end with</option>' +
        '<option value="doesnot_contains">Doesnot contains</option>' +
        '</select>' +
        '</div>' +
        '<div class="col-lg-3 col-sm-6 pb-2">' +
        '<input required name="logic_value_'+index+'" type="text" class="form-control" placeholder="Add Text">' +
        '</div>' +
        '<div class="col-8 col-lg-2 col-sm-4 pb-2">' +
        '<select required name="logic_operator_'+index+'" class="form-control">' +
        '<option value="and" selected>And</option>' +
        '<option value="or">Or</option>' +
        '</select>' +
        '</div>' +
        '<div class="col-4 col-lg-1 col-sm-2 pb-2">' +
        '<button type="button" class="btn btn-outline-dark close_btn"><i class="fas fa-times"></i></button>' +
        '</div>' +
        '</div>';
    return data;
}
let i = 0;
function betweenExtraField(){
    $('.date-pick-logic').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        let target_value = $(this).attr('data-target')
        if(valueSelected == 'between'){
            console.log(find('#date_pick_value_'+target_value))
            $('#extra_filed_'+target_value).remove()
            if(!find('#date_pick_value_'+target_value)){
                $('#date_pick_value_'+target_value).append(extraDateFiled(target_value))
            }
        }else{
            $('#extra_filed_'+target_value).remove()
        }
    });
}
function close_btn(){
    $('.close_btn').click(function () {
        $(this).parent().parent().remove();
    })
}

close_btn()
betweenExtraField()

$('#addDateLogic').click(function () {
    i++;
    $('#segment-logic-fields').append(dateLogicFields(i))
    close_btn()
    betweenExtraField()
})
$('#addTextLogic').click(function () {
    i++;
    $('#segment-logic-fields').append(textLogicFields(i))
    close_btn()
})
function submitNullCheck(){
    console.log($('.segment-logic').length)

    if ($('.segment-logic').length > 0){
        return true;
    }
    alert('please Add at least one logic!')
    return false;
}
