{{--Modal para agregar una Tarea--}}
<div class="modal fade" role="dialog" id="taskLeadModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{trans('crudbooster.task_creation')}}</h4>
            </div>

            <form id="form_product" data-parsley-validate  action="" method="post" class="form-horizontal">

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="col-md-10">
                            <input type="hidden" id="lead_id" value="{{ $id }}">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.name')}}*</label>
                                <div class="col-md-8">
                                    <input type="text" title="Name" required class="form-control" name="name" id="name" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.date_due')}}*</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input required name="date_due" id="date_due" class="form-control date-picker" value="" type="text" data-date-format="yyyy-mm-dd">
                                        <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.notification_email')}}*</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input required name="reminder_email" id="reminder_email" class="form-control date-picker" value="" type="text" data-date-format="yyyy-mm-dd">
                                        <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <img class="direct-chat-img" src="<?php echo e(asset('assets/images/admin.jpg')); ?>" alt="message user image">
                            <div class="direct-chat-text">
                                {{trans('crudbooster.task_help')}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="addSaveTask">{{trans('crudbooster.add')}}</button>
                </div>

            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>