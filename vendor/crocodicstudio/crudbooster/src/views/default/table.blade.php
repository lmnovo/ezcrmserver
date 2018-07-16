            <script type="text/javascript">
                  $(document).ready(function() {
                      var $window = $(window);
                      function checkWidth() {
                          var windowsize = $window.width();
                          if (windowsize > 500) {
                              console.log(windowsize);
                              $('#box-body-table').removeClass('table-responsive');
                          }else{
                              console.log(windowsize);
                              $('#box-body-table').addClass('table-responsive');
                          }
                      }
                      checkWidth();
                      $(window).resize(checkWidth);

                      $('.selected-action ul li a').click(function() {
                        var name = $(this).data('name');
                        console.log(name);

                        $('#form-table input[name="button_name"]').val(name);
                        var title = $(this).attr('title');

                        swal({
                          title: "{{trans("crudbooster.confirmation_title")}}",
                          text: "{{trans("crudbooster.alert_bulk_action_button")}} "+title+" ?",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#008D4C",
                          confirmButtonText: "{{trans('crudbooster.confirmation_yes')}}",
                          closeOnConfirm: false,
                          showLoaderOnConfirm:true
                        },
                        function(){
                          $('#form-table').submit();
                        });

                      })

                      $('table tbody tr .button_action a').click(function(e) {
                        e.stopPropagation();
                      })
                  });
                </script>

             <?php
                $id_table = explode('crm/', CRUDBooster::mainpath("action-selected"));
                $id_table = explode('/', $id_table[1]);
             ?>

                  <form id='form-table' method='post' action='{{CRUDBooster::mainpath("action-selected")}}'>
                  <input type='hidden' name='button_name' value=''/>
                  <input type='hidden' name='_token' value='{{csrf_token()}}'/>
                   <?php echo ("<table id='table_dashboard' class='table table-hover table-striped table-bordered table_class_$id_table[0]'>"); ?>

                    <thead>
                    <tr class="active">
                      <?php if($button_bulk_action):?>
                      <th width='3%'><input type='checkbox' id='checkall'/></th>
                      <?php endif;?>
                      <?php if($show_numbering):?>
                      <th width="1%">{{ trans('crudbooster.no') }}</th>
                      <?php endif;?>
                      <?php
                        foreach($columns as $col) {
                            if($col['visible']===FALSE) continue;

                            $sort_column = Request::get('filter_column');
                            $colname = $col['label'];
                            $name = $col['name'];
                            $field = $col['field_with'];
                            $width = ($col['width'])?:"auto";
                            $mainpath = trim(CRUDBooster::mainpath(),'/').$build_query;
                            echo "<th width='$width'>";
                            if(isset($sort_column[$field])) {
                              switch($sort_column[$field]['sorting']) {
                                case 'asc':
                                  $url = CRUDBooster::urlFilterColumn($field,'sorting','desc');
                                  echo "<a href='$url' title='Click to sort descending'>$colname &nbsp; <i class='fa fa-sort-desc'></i></a>";
                                  break;
                                case 'desc':
                                  $url = CRUDBooster::urlFilterColumn($field,'sorting','asc');
                                  echo "<a href='$url' title='Click to sort ascending'>$colname &nbsp; <i class='fa fa-sort-asc'></i></a>";
                                  break;
                                default:
                                  $url = CRUDBooster::urlFilterColumn($field,'sorting','asc');
                                  echo "<a href='$url' title='Click to sort ascending'>$colname &nbsp; <i class='fa fa-sort'></i></a>";
                                  break;
                              }
                            }else{
                                  $url = CRUDBooster::urlFilterColumn($field,'sorting','asc');
                                  echo "<a href='$url' title='Click to sort ascending'>$colname &nbsp; <i class='fa fa-sort'></i></a>";
                            }


                            echo "</th>";
                        }
                      ?>

                      @if($button_table_action)
                        @if(CRUDBooster::isUpdate() || CRUDBooster::isDelete() || CRUDBooster::isRead())
                            <th width='{{$button_action_width?:"auto"}}' style="text-align:right">{{trans("crudbooster.action_label")}}</th>
                        @endif
                      @endif
                    </tr>
                    </thead>
                    <tbody>
                      @if(count($result)==0)
                      <tr class='warning'>
                          <?php if($button_bulk_action && $show_numbering):?>
                          <td colspan='{{count($columns)+3}}' align="center">
                          <?php elseif( ($button_bulk_action && !$show_numbering) || (!$button_bulk_action && $show_numbering) ):?>
                          <td colspan='{{count($columns)+2}}' align="center">
                          <?php else:?>
                          <td colspan='{{count($columns)+1}}' align="center">
                          <?php endif;?>

                          <i class='fa fa-search'></i> {{trans("crudbooster.table_data_not_found")}}
                          </td>
                      </tr>
                      @endif

                      @foreach($html_contents['html'] as $i=>$hc)

                          @if($table_row_color)
                            <?php $tr_color = NULL;?>
                            @foreach($table_row_color as $trc)
                              <?php
                                  $query = $trc['condition'];
                                  $color = $trc['color'];
                                  $row = $html_contents['data'][$i];
                                  foreach($row as $key=>$val) {
                                    $query = str_replace("[".$key."]",'"'.$val.'"',$query);
                                  }

                                  @eval("if($query) {
                                      \$tr_color = \$color;
                                  }");
                              ?>
                            @endforeach
                            <?php echo "<tr class='$tr_color'>";?>
                          @else
                            <tr>
                          @endif

                              @foreach($hc as $h)
                                <td>{!! $h !!}</td>
                              @endforeach
                          </tr>
                      @endforeach
                    </tbody>


                    <tfoot>

                    </tfoot>
                  </table>

                  </form><!--END FORM TABLE-->

            <p style="padding-left: 2%; font-weight: bold">
                <?php
                    if ($result->currentPage() == 1) {
                        if ($result->perPage() > $result->total()) {
                            if ($result->total() == 0) {
                                $startPage = 0;
                                $endPage = $result->total();
                            }
                            else {
                                $startPage = 1;
                                $endPage = $result->total();
                            }
                        }
                        else {
                            $startPage = 1;
                            $endPage = $result->perPage() * $result->currentPage();
                        }
                    }
                    elseif ($result->currentPage() == $result->lastPage()) {
                        $startPage = $result->perPage() * ($result->currentPage()-1) + 1;
                        $endPage = $result->total();
                    } else {
                        $startPage = $result->perPage() * $result->currentPage() - ($result->perPage() - 1);
                        $endPage = $result->perPage() * $result->currentPage();
                    }
                    echo ( trans('crudbooster.showing').' '.$startPage.' '.trans('crudbooster.To').' '.$endPage.' '.trans('crudbooster.of').' '.$result->total().' '.trans('crudbooster.results'));
                ?>
            </p>

            <div style="text-align: right;">
                <p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
            </div>

            @if($columns)
            <script>
            $(function(){
              $('.btn-filter-data').click(function() {
                $('#filter-data').modal('show');
              })

              $('.btn-export-data').click(function() {
                $('#export-data').modal('show');
              })

              var toggle_advanced_report_boolean = 1;
              $(".toggle_advanced_report").click(function() {

                if(toggle_advanced_report_boolean==1) {
                  $("#advanced_export").slideDown();
                  $(this).html("<i class='fa fa-minus-square-o'></i> {{trans('crudbooster.export_dialog_show_advanced')}}");
                  toggle_advanced_report_boolean = 0;
                }else{
                  $("#advanced_export").slideUp();
                  $(this).html("<i class='fa fa-plus-square-o'></i> {{trans('crudbooster.export_dialog_show_advanced')}}");
                  toggle_advanced_report_boolean = 1;
                }

              })


              $("#table_dashboard .checkbox").click(function() {
                var is_any_checked = $("#table_dashboard .checkbox:checked").length;
                if(is_any_checked) {
                  $(".btn-delete-selected").removeClass("disabled");
                }else{
                  $(".btn-delete-selected").addClass("disabled");
                }
              })

              $("#table_dashboard #checkall").click(function() {
                var is_checked = $(this).is(":checked");
                $("#table_dashboard .checkbox").prop("checked",!is_checked).trigger("click");
              })

              $('#btn_advanced_filter').click(function() {
                $('#advanced_filter_modal').modal('show');
              })

              $(".filter-combo").change(function() {
                var n = $(this).val();
                var p = $(this).parents('.row-filter-combo');
                var type_data = $(this).attr('data-type');
                var filter_value = p.find('.filter-value');

                p.find('.between-group').hide();
                p.find('.between-group').find('input').prop('disabled',true);
                filter_value.val('').show().focus();
                switch(n) {
                  default:
                    filter_value.removeAttr('placeholder').val('').prop('disabled',true);
                    p.find('.between-group').find('input').prop('disabled',true);
                  break;
                  case 'like':
                  case 'not like':
                    filter_value.attr('placeholder','{{trans("crudbooster.filter_eg")}} : {{trans("crudbooster.filter_lorem_ipsum")}}').prop('disabled',false);
                  break;
                  case 'asc':
                    filter_value.prop('disabled',true).attr('placeholder','{{trans("crudbooster.filter_sort_ascending")}}');
                  break;
                  case 'desc':
                    filter_value.prop('disabled',true).attr('placeholder','{{trans("crudbooster.filter_sort_descending")}}');
                  break;
                  case '=':
                    filter_value.prop('disabled',false).attr('placeholder','{{trans("crudbooster.filter_eg")}} : {{trans("crudbooster.filter_lorem_ipsum")}}');
                  break;
                  case '>=':
                    filter_value.prop('disabled',false).attr('placeholder','{{trans("crudbooster.filter_eg")}} : 1000');
                  break;
                  case '<=':
                    filter_value.prop('disabled',false).attr('placeholder','{{trans("crudbooster.filter_eg")}} : 1000');
                  break;
                  case '>':
                    filter_value.prop('disabled',false).attr('placeholder','{{trans("crudbooster.filter_eg")}} : 1000');
                  break;
                  case '<':
                    filter_value.prop('disabled',false).attr('placeholder','{{trans("crudbooster.filter_eg")}} : 1000');
                  break;
                  case '!=':
                    filter_value.prop('disabled',false).attr('placeholder','{{trans("crudbooster.filter_eg")}} : {{trans("crudbooster.filter_lorem_ipsum")}}');
                  break;
                  case 'in':
                    filter_value.prop('disabled',false).attr('placeholder','{{trans("crudbooster.filter_eg")}} : {{trans("crudbooster.filter_lorem_ipsum_dolor_sit")}}');
                  break;
                  case 'not in':
                    filter_value.prop('disabled',false).attr('placeholder','{{trans("crudbooster.filter_eg")}} : {{trans("crudbooster.filter_lorem_ipsum_dolor_sit")}}');
                  break;
                  case 'between':
                    filter_value.val('').hide();
                    p.find('.between-group input').prop('disabled',false);
                    p.find('.between-group').show().focus();
                    p.find('.filter-value-between').prop('disabled',false);
                  break;
                }
              })

              /* Remove disabled when reload page and input value is filled */
              $(".filter-value").each(function() {
                var v = $(this).val();
                if(v != '') $(this).prop('disabled',false);
              })

            })
            </script>
            <!-- MODAL FOR SORTING DATA-->
            <div class="modal fade" tabindex="-1" role="dialog" id='advanced_filter_modal'>
              <div class="modal-dialog modal-lg">
                <div class="modal-content" >
                  <div class="modal-header">
                    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class='fa fa-filter'></i> {{trans("crudbooster.filter_dialog_title")}}</h4>
                  </div>
                  <form method='get' action=''>
                    <div class="modal-body">
                      <?php foreach($columns as $key => $col):?>
                        <?php if( isset($col['image']) || isset($col['download']) || $col['visible']===FALSE) continue;?>

                      <div class='form-group'>

                        <div class='row-filter-combo row'>

                          <div class="col-sm-2">
                            <strong>
                                {{  $col['label'] }}
                            </strong>
                          </div>

                          <div class='col-sm-3'>
                            <select name='filter_column[{{$col["field_with"]}}][type]' data-type='{{$col["type_data"]}}' class="filter-combo form-control">
                              <option value=''>** {{trans("crudbooster.filter_select_operator_type")}}</option>

                                  @if( $col['label'] == 'Type Lead' or $col['label'] == 'Type Quote' or $col['label'] == 'Lead Type')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Type Lead' or $col['label'] == 'Type Quote' or $col['label'] == 'Tipo de Prospecto')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Financing' or $col['label'] == 'Financiamiento')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Name' or $col['label'] == 'Last Name' or $col['label'] == 'Business Name' or $col['label'] == 'Address' or $col['label'] == 'City' or $col['label'] == 'Template' or $col['label'] == 'Phase Type')
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'like')?"selected":"" }} value='like'>{{trans("crudbooster.filter_like")}}</option>

                                  @elseif( $col['label'] == 'Nombre' or $col['label'] == 'Apellido' or $col['label'] == 'Business Name' or $col['label'] == 'Address' or $col['label'] == 'City' or $col['label'] == 'Template' or $col['label'] == 'Phase Type')
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'like')?"selected":"" }} value='like'>{{trans("crudbooster.filter_like")}}</option>

                                  @elseif( $col['label'] == 'Telephone' or $col['label'] == 'Teléfono')
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'like')?"selected":"" }} value='like'>{{trans("crudbooster.filter_like")}}</option>
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'not like')?"selected":"" }} value='not like'>{{trans("crudbooster.filter_not_like")}}</option>
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Email' or $col['label'] == 'Correo Electrónico')
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'like')?"selected":"" }} value='like'>{{trans("crudbooster.filter_like")}}</option>
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'not like')?"selected":"" }} value='not like'>{{trans("crudbooster.filter_not_like")}}</option>
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Assign to' or $col['label'] == 'Assigned To' or $col['label'] == 'Assign To' or $col['label'] == 'User')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Responsable' or $col['label'] == 'Assigned To' or $col['label'] == 'Assign To' or $col['label'] == 'User')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Date' or $col['label'] == 'Creation Date' or $col['label'] == 'Updated Date' or $col['label'] == 'Time Access')
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'between')?"selected":"" }} value='between'>{{trans("crudbooster.filter_between")}}</option>

                                  @elseif( $col['label'] == 'Fecha' or $col['label'] == 'Fecha Creación' or $col['label'] == 'Fecha Actualización' or $col['label'] == 'Time Access')
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'between')?"selected":"" }} value='between'>{{trans("crudbooster.filter_between")}}</option>

                                  @elseif( $col['label'] == 'State' or $col['label'] == 'Source')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Notes' or $col['label'] == 'Notas')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Estado' or $col['label'] == 'Source')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Size')
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'like')?"selected":"" }} value='like'>{{trans("crudbooster.filter_like")}}</option>

                                  @elseif( $col['label'] == 'Privilege')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @elseif( $col['label'] == 'Quotes' or $col['label'] == 'Budget' or $col['label'] == 'Total' or $col['label'] == 'Total Sent' or $col['label'] == 'Sell Price' or $col['label'] == 'Stock')
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '>=')?"selected":"" }} value='>='>{{trans("crudbooster.filter_greater_than_or_equal")}}</option>
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '<=')?"selected":"" }} value='<='>{{trans("crudbooster.filter_less_than_or_equal")}}</option>

                                  @elseif( $col['label'] == 'Cotizaciones' or $col['label'] == 'Budget' or $col['label'] == 'Total' or $col['label'] == 'Total Sent' or $col['label'] == 'Sell Price' or $col['label'] == 'Stock')
                                     <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>
                                     <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '>=')?"selected":"" }} value='>='>{{trans("crudbooster.filter_greater_than_or_equal")}}</option>
                                     <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '<=')?"selected":"" }} value='<='>{{trans("crudbooster.filter_less_than_or_equal")}}</option>

                                  @elseif( $col['label'] == 'Interested' or $col['label'] == 'Interesed' or $col['label'] == 'Type' )
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>

                                  @else
                                    @if(in_array($col['type_data'],['string','varchar','text','char']))<option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'like')?"selected":"" }} value='like'>{{trans("crudbooster.filter_like")}}</option> @endif
                                    @if(in_array($col['type_data'],['string','varchar','text','char']))<option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'not like')?"selected":"" }} value='not like'>{{trans("crudbooster.filter_not_like")}}</option>@endif

                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '=')?"selected":"" }} value='='>{{trans("crudbooster.filter_equal_to")}}</option>
                                    @if(in_array($col['type_data'],['int','integer','double','float','decimal']))<option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '>=')?"selected":"" }} value='>='>{{trans("crudbooster.filter_greater_than_or_equal")}}</option>@endif
                                    @if(in_array($col['type_data'],['int','integer','double','float','decimal']))<option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '<=')?"selected":"" }} value='<='>{{trans("crudbooster.filter_less_than_or_equal")}}</option>@endif
                                    @if(in_array($col['type_data'],['int','integer','double','float','decimal']))<option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '<')?"selected":"" }} value='<'>{{trans("crudbooster.filter_less_than")}}</option>@endif
                                    @if(in_array($col['type_data'],['int','integer','double','float','decimal']))<option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '>')?"selected":"" }} value='>'>{{trans("crudbooster.filter_greater_than")}}</option>@endif
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == '!=')?"selected":"" }} value='!='>{{trans("crudbooster.filter_not_equal_to")}}</option>
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'in')?"selected":"" }} value='in'>{{trans("crudbooster.filter_in")}}</option>
                                    <option typeallow='all' {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'not in')?"selected":"" }} value='not in'>{{trans("crudbooster.filter_not_in")}}</option>
                                    @if(in_array($col['type_data'],['date','time','datetime','int','integer','double','float','decimal','timestamp']))<option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'between')?"selected":"" }} value='between'>{{trans("crudbooster.filter_between")}}</option>@endif
                                    <option {{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'empty')?"selected":"" }} value='empty'>Empty ( or Null)</option>
                              @endif

                            </select>
                          </div><!--END COL_SM_4-->



                          <div class='col-sm-5'>
                              @if( $col['label'] == 'Type Lead' or $col['label'] == 'Lead Type' or $col['label'] == 'Tipo de Prospecto' )
                                  <select id="type_lead_filter" class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                    <option></option>
                                      <?php
                                      $result = \Illuminate\Support\Facades\DB::table('leads_type')->get();

                                      foreach($result as $item) {
                                          echo "<option value='$item->name'>$item->name</option>";
                                      }
                                      ?>
                                  </select>
                              <br>

                              @elseif( $col['label'] == 'Type Quote' )
                                  <select id="type_lead_filter" class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                    <option></option>
                                    <option>Lead</option>
                                    <option>Client</option>
                                  </select>
                                  <br>

                              @elseif( $col['label'] == 'Financing' )
                                  <select id="type_lead_filter" class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                      <option></option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>
                                  <br>

                              @elseif( $col['label'] == 'Financiamiento' )
                                  <select id="type_lead_filter" class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                      <option></option>
                                      <option value="Yes">Sí</option>
                                      <option value="No">No</option>
                                  </select>
                                  <br>

                              @elseif( $col['label'] == 'Notes')
                                  <select id="notes_filter" class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                      <option></option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                  </select>
                                  <br>

                              @elseif( $col['label'] == 'Notas')
                                  <select id="notes_filter" class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                      <option></option>
                                      <option value="Yes">Sí</option>
                                      <option value="No">No</option>
                                  </select>
                                  <br>

                              @elseif( $col['label'] == 'Assign to' or $col['label'] == 'Assign To' or $col['label'] == 'Assigned To' or $col['label'] == 'User')
                                <select class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                  <option></option>
                                  <?php
                                      $result = \Illuminate\Support\Facades\DB::table('cms_users')->get();

                                      foreach($result as $item) {
                                          echo "<option value='$item->name'>$item->name</option>";
                                      }
                                  ?>
                                </select>
                                <br>

                            @elseif( $col['label'] == 'State' or $col['label'] == 'Estado')
                              <select class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                <option></option>
                                  <?php
                                  $result = \Illuminate\Support\Facades\DB::table('states')->get();

                                  foreach($result as $item) {
                                      echo "<option value='$item->abbreviation'>$item->abbreviation</option>";
                                  }
                                  ?>
                              </select>
                              <br>

                            @elseif( $col['label'] == 'Size' )
                              <select class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                  <option></option>
                                  <?php
                                  $result = \Illuminate\Support\Facades\DB::table('sizes')->get();

                                  foreach($result as $item) {
                                      echo "<option value='$item->name'>$item->name</option>";
                                  }
                                  ?>
                              </select>
                              <br>

                             @elseif( $col['label'] == 'Privilege' )
                               <select class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                  <option></option>
                                  <?php
                                  $result = \Illuminate\Support\Facades\DB::table('cms_privileges')->get();

                                  foreach($result as $item) {
                                      echo "<option value='$item->name'>$item->name</option>";
                                  }
                                  ?>
                               </select>
                               <br>

                            @elseif( $col['label'] == 'Source' )
                              <select class="filter-value form-control" name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>
                                <option></option>
                                  <?php
                                  $result = \Illuminate\Support\Facades\DB::table('sources')->get();

                                  foreach($result as $item) {
                                      echo "<option value='$item->name'>$item->name</option>";
                                  }
                                  ?>
                              </select>
                              <br>

                               @else
                                  <input type='text' class='filter-value form-control' style="{{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'between')?"display:none":"display:block"}}" disabled name='filter_column[{{$col["field_with"]}}][value]' value='{{ (!is_array(CRUDBooster::getValueFilter($col["field_with"])))?CRUDBooster::getValueFilter($col["field_with"]):"" }}'>

                                  <div class='row between-group' style="{{ (CRUDBooster::getTypeFilter($col["field_with"]) == 'between')?"display:block":"display:none" }}">
                                    <div class='col-sm-6'>
                                      <div class='input-group'>
                                        <span class="input-group-addon">From:</span>
                                        <input
                                                {{ (CRUDBooster::getTypeFilter($col["field_with"]) != 'between')?"disabled":"" }}
                                                type='text'
                                                class='filter-value-between form-control {{ (in_array($col["type_data"],["date","time","datetime","timestamp"]))?"datepicker":"" }}' readonly placeholder='{{$col["label"]}} {{trans("crudbooster.filter_from")}}' name='filter_column[{{$col["field_with"]}}][value][]' value='<?php
                                        $value = CRUDBooster::getValueFilter($col["field_with"]);
                                        echo (CRUDBooster::getTypeFilter($col["field_with"])=='between')?$value[0]:"";
                                        ?>'>
                                      </div>
                                    </div>
                                    <div class='col-sm-6'>
                                      <div class='input-group'>
                                        <span class="input-group-addon">To:</span>
                                        <input
                                                {{ (CRUDBooster::getTypeFilter($col["field_with"]) != 'between')?"disabled":"" }}
                                                type='text'
                                                class='filter-value-between form-control {{ (in_array($col["type_data"],["date","time","datetime","timestamp"]))?"datepicker":"" }}' readonly placeholder='{{$col["label"]}} {{trans("crudbooster.filter_to")}}' name='filter_column[{{$col["field_with"]}}][value][]' value='<?php
                                        $value = CRUDBooster::getValueFilter($col["field_with"]);
                                        echo (CRUDBooster::getTypeFilter($col["field_with"])=='between')?$value[1]:"";
                                        ?>'>
                                      </div>
                                    </div>
                                  </div>
                              </div><!--END COL_SM_6-->

                              <div class='col-sm-2'>
                                <select class='form-control' name='filter_column[{{$col["field_with"]}}][sorting]'>
                                  <option value=''>** Sorting</option>
                                  <option {{ (CRUDBooster::getSortingFilter($col["field_with"]) == 'asc')?"selected":"" }} value='asc'>{{trans("crudbooster.filter_ascending")}}</option>
                                  <option {{ (CRUDBooster::getSortingFilter($col["field_with"]) == 'desc')?"selected":"" }} value='desc'>{{trans("crudbooster.filter_descending")}}</option>
                                </select>
                              </div><!--END_COL_SM_2-->

                            @endif

                        </div>

                      </div>
                      <?php endforeach;?>

                    </div>
                    <div class="modal-footer" align="right">
                      <button class="btn btn-default" type="button" data-dismiss="modal">{{trans("crudbooster.button_close")}}</button>
                      <button class="btn btn-default btn-reset" type="reset" onclick='location.href="{{Request::get("lasturl")}}"' >{{trans("crudbooster.button_reset")}}</button>
                      <button class="btn btn-primary btn-submit" type="submit">{{trans("crudbooster.button_submit")}}</button>
                    </div>
                    <input type="hidden" name="lasturl" value="{{Request::get('lasturl')?:Request::fullUrl()}}">
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
            </div>



                <!-- /.modal-content -->
              </div>
            </div>

            @endif