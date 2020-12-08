$('#tb_item').DataTable();


function trCheck(e){
    // alert('');
    if($(e).is(':checked')){
        $('.pilih').prop('checked',true);
    }else{
        $('.pilih').prop('checked',false);
    }
    
}

function opForm(){
	$.confirm({
		title:'Upload File',
		content:`
			<form id="uploadXLS" enctype="multipart/form-data" method="post">
				<div class="form-group">
					<label for="file-import">Pilih FIle</label>
					<input class="form-control" id="file-import" type="file" accept=".xls,.xlsx"/>
				</div>
			</form>
		`,
        buttons:{
            submit:{
                text:'Submit',
                btnClass:'btn-success',
                action:()=>{
                    var self = this;

                    var fd = new FormData();
                    var files = $('#file-import')[0].files;
                    fd.append('file_input',files[0]);

                    $.ajax({
                        url: '/import/upload',
                        type: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function(d){

                            $.confirm({
                                title:'LIST ITEM IMPORT',
                                columnClass:'col-12',
                                content:d,
                                buttons:{
                                    submit:{
                                        text:'Proses',
                                        btnClass:'btn-primary'
                                    },
                                    cancel:{
                                        text:'Cancel'
                                    }
                                }
                            });
                            // if(response != 0){
                            //     $("#img").attr("src",response); 
                            //     $(".preview img").show(); // Display image element
                            // }else{
                            //     alert('file not uploaded');
                            // }
                        },
                    });
                }
            },
            cancel:{
                text:'Cancel',
                btnClass:'btn-default'
            }
        }
	});
}
