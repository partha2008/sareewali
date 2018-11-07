	// user-defined function
    function onDeleteConfirm(link){
        bootbox.confirm({
            message: 'Are you sure want to delete?',
            buttons: {
                confirm: {
                    label: 'Yes',
                    link: link
                },
                cancel: {
                    label: 'No'
                }
            },
            callback: function (result) {
                if(result){
                    window.location.href = this.buttons.confirm.link;
                }
            }
        });
    }  
    
    $(function(){
        // Replace the <textarea id="term"> with a CKEditor
        // instance, using default configuration.
        if($("#term").length > 0){
            CKEDITOR.replace('term');
        }
        
        // jQuery Datepicker
        $('#created_date').datepicker({ dateFormat: 'mm-dd-yy' });

        $('#dataTable').DataTable( {
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": BASEPATH+"admin/product/get_products",
            "rowCallback": function(row, data, index){
                if(data.status == 'Active')
                    $(row).find('td:eq(5)').css({'color': '#3c763d', 'font-weight': 'bold'});
                else
                    $(row).find('td:eq(5)').css({'color': '#a94442', 'font-weight': 'bold'});

                $(row).find('td:eq(5) .btn-success').attr("href", BASEPATH+"admin/product-edit/"+data.slug);
                
                var del_path = BASEPATH+'admin/product/product_delete/'+data.slug;
                if(data.status == 'Active')
                    $(row).find('td:eq(5) .btn-danger').attr("onclick", "onDeleteConfirm('"+del_path+"')");
                else
                    $(row).find('td:eq(5) .btn-danger').remove();
            },
            "columns": [
                { "data": "name", "visible": false }, 
                { "data": "name" },
                { "data": "sku" },
                { "data": "quantity" },
                { "data": "price" },
                { "data": "status"},
                { "data":null, "defaultContent":"<a href='' class='btn btn-success' title='Edit'>Edit</a>&nbsp;<a href='javscript:void(0)' class='btn btn-danger' title='Delete'>Delete</a>"}
            ]
        });

        $("#add_attr_btn").click(function(){
            var str = $("#attrelm").html();
            
            $("#container").append(str).find("button.btn-circle").addClass("btn-remove").attr("mode", "add");
            $("#container").find("input:text").prop('required',true);
        });

        $(document).on("click", ".btn-remove", function(){
            var me = $(this);            

            if(me.attr('mode') == 'edit'){
                $.post(BASEPATH+"admin/product/product_attribute_delete", {product_attribute_id: me.attr('key')}, function(data){
                    if(data.trim() == 'success'){
                        me.parent().parent().remove();

                        if($("#container").html().trim() == ''){
                            $("#attrelm").removeClass("hidden");
                            $("#attrelm").find("input:text").prop('required',true);
                        }
                    }
                });
            }else{
                me.parent().parent().remove();
            }
        });

        $('#fine-uploader-manual-trigger').fineUploader({
            template: 'qq-template-manual-trigger',
            request: {
                endpoint: BASEPATH+"admin/product/save_product_images"
            },
            validation: {
                allowedExtensions: ['jpeg', 'jpg']
            },
            thumbnails: {
                placeholders: {
                    waitingPath: BASEPATH+'/assets/images/waiting-generic.png',
                    notAvailablePath: BASEPATH+'/assets/images/not_available-generic.png'
                }
            },
            autoUpload: false,
            callbacks: {
                onAllComplete: function() {
                    $("#upload_image").val('true');
                },
                onSubmitted: function(id, name){
                    $.post(BASEPATH+'admin/product/unlink_product_image');
                },
                onSessionRequestComplete: function(response, flag){
                    if(flag){
                        if(response.length > 0){
                            for(var i=0;i<response.length;i++){
                                if(response[i].is_featured == "Y"){
                                    $(document).find("#fine-uploader-manual-trigger ul li").eq(i).css("border", "2px solid #d43f3a").find("input:radio").prop('checked', true);
                                }
                                $(document).find("#fine-uploader-manual-trigger ul li").eq(i).find("input:radio").val(response[i].product_image_id).attr("product_id", response[i].product_id);
                            }
                        }
                    }
                },                
                onDeleteComplete: function(id, xhr, isError){
                    if(!isError){
                        var response = JSON.parse(xhr.responseText);
                        var product_image_id = response.product_image_id;
                        if(product_image_id){
                            $(document).find("#fine-uploader-manual-trigger ul li").find("input:radio[value='"+product_image_id+"']").closest("li").css("border", "2px solid #d43f3a").find("input:radio").prop('checked', true);
                        }                        
                    }
                }
            },
            session: {
                endpoint: BASEPATH+"admin/product/get_product_images/"+$("#product_id").val()
            },
            deleteFile: {
                enabled: true,
                forceConfirm: true,
                endpoint: BASEPATH+"admin/product/delete_product_images"
            }
        });

        $(document).on("click", ".feature_cls", function(){
            var me = $(this);

            $.post(BASEPATH+"admin/product/make_product_image_featured", {val: me.val(), product_id: me.attr("product_id")}, function(res){
                if(res.trim() == "success"){
                    $(document).find("#fine-uploader-manual-trigger ul li").css("border", "none").prop('checked', false);
                    me.closest("li").css("border", "2px solid #d43f3a");
                }                
            });
        });

        $('#trigger-upload').click(function() {
            $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });

        $("#edit_product").click(function(e){
            if($(".qq-upload-list .qq-upload-success").length > 0){                
                $("#upload_image").val('true');
            }else{
                $("#upload_image").val('');
            }            
        });

        // open modal to view entiy relationship
        $("#view_relation").click(function(){
            $.post(BASEPATH+"admin/entity/entity_relation", function(data){
                var str = '<div class="modal fade" id="myModal" role="dialog"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Entity Relationship</h4> </div><div class="modal-body">'+data+'</div><div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button> </div></div></div></div>';
                $('body').append(str);
                $('#myModal').modal('show');
                $('#myModal').on('hidden.bs.modal', function () {
                    $('#myModal').remove();
                });
            });            
        });

        $("#country_id").change(function(){
            var me = $(this);
            $.post(BASEPATH+"admin/user/get_state_by_country", {country_id: me.val()}, function(data){
                $("#state_id").html(data);
            });
        });

        $(".js-example-tags").select2({
            tags: true
        });

        $("#prd_dis_btn").click(function(){
            if($("#prd_dic_chk").is(':checked')){ 
                var prd_dis_amt = $("#prd_dis_amt").val();
                var prd_amt = $("#label_price").val();  
                if(prd_dis_amt && prd_amt){
                    var mode = $("#prd_dis_mode option:selected").val();
                    if(mode == "flat"){
                        var discounted_price = parseFloat(prd_amt)-parseFloat(prd_dis_amt);
                    }else{
                        var dis = (parseFloat(prd_amt)*parseFloat(prd_dis_amt))/100;
                        var discounted_price = (parseFloat(prd_amt))-dis;
                    }

                    $("#prd_dis_price").val(discounted_price);
                }                
            }
        });

        $("#prd_dic_chk").click(function(){
            if(!$(this).is(':checked')){
                $("#prd_dis_price").val("");
                $("#prd_dis_amt").val("");
                $('#prd_dis_mode').prop('selectedIndex',0);
            }
        });

    });