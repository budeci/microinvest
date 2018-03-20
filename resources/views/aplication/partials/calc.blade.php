<!-- Modal -->
<div class="modal fade" id="modal-calc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Calculați rata lunară</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('getPaymentSchedule')}}" method="post" id="calc-payment-schedule">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Produsul financiar:</label>
                                <select name="calc[loanProductID]" class="js-product-calc form-control custom-select" required>
                                    @foreach($loanProduct as $item)
                                        <option {{ old('calc.loanProductID') ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Suma (MDL):</label>
                                <input value="{{ old('calc.amount') }}" name="calc[amount]" type="number" class="js-amount-calc form-control" placeholder="2000" required min="2000" max="500000">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Termen (luni):</label>
                                <input value="{{ old('calc.term') }}" name="calc[term]" type="number" class="form-control" placeholder="24" required min="3" max="36">
                            </div>
                        </div>
                       <!--  <div class="col">
                           <div class="form-group">
                               <label>Valuta:</label>
                               <select name="calc[currency]" class="form-control custom-select currency-calc" required>
                                   @foreach(Config::get('app.currency') as $key => $item)
                                       <option {{ old('calc.currency') ? 'selected' : '' }} value="{{ $key }}">{{ $item }}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>  -->
                        <input type="hidden" name="calc[currency]" value="498">
                        {!! csrf_field() !!}
                    </div>
                </form>
                <div class="row" id="payment-schedule-response">
                    <div class="col js-schendule-error" style="display: none;">
                        <h5>Verificați corectitudinea parametrilor introduși (termen, suma, tip credit)</h5>
                    </div>
                    
                    <div class="col js-schendule-success" style="display: none;">
                        <h5>Plata lunară:</h5>
                        <div class="js-schendule table-responsive schendule schendulev1">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <!-- <th>#</th> -->
                                        <th>Termen</th>
                                        <th>Rata lunară</th>
                                        <!-- <th>Costul creditului</th> -->
                                        <th>Total spre plată</th>
                                        <th title="Dobânda anuala efectivă">DAE (lunar)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="calc-payment-schedule" class="btn-calc-payment-schedule btn btn-success">Calculați</button>
            </div>
        </div>
    </div>
</div>


@section('script')
    <script>
       $(document).ready(function() {
           $('#calc-payment-schedule').submit(function(event) {
                event.preventDefault();
                var current = $(this),
                    html = '',
                    currency = current.find('.currency-calc option:selected').text(),
                    currencyDefault = 'MDL',
                    serialize = current.serialize();
                    $.ajax({
                        url: "{{ route('getPaymentSchedule') }}",
                        data: serialize,
                        method: 'POST',
                        beforeSend: function(){
                            $(".btn-calc-payment-schedule").attr('disabled', true);
                            $(".js-schendule-success, .js-schendule-error").hide();
                            $("#payment-schedule-response").css('min-height', '200px').LoadingOverlay("show");
                        },
                        success: function (data) {
                            if (data.redirect) { window.location.href = data.redirect; }
                            if (data.respons) {
                                var appCurrency = <?= json_encode(Config::get('app.currency')) ?>; 
                                $.each(data.result, function(index, item) {
                                    var currency = appCurrency[item.currency];
                                    html += "<tr>"
                                                /*+"<th scope='row'>"+index+"</th>"*/
                                                +"<td class='js-term-calc'>"+item.term+"</td>"
                                                +"<td>"+item.mounthlyPayment+" "+currency+"</td>"
                                                /* +"<td>"+parseFloat(item.totalAmountDue-item.amount).toFixed(2)+" "+currency+"</td>"*/
                                                +"<td>"+item.totalAmount+" "+currency+"</td>"
                                                +"<td>"+parseFloat(item.IRR).toFixed(2)+" %</td>"
                                            +"</tr>";
                                });
                                $("#payment-schedule-response table tbody").html(html);
                                $(".js-schendule-success").fadeIn();
                            }else{
                                $(".js-schendule-error").fadeIn();
                            }
                            $("#payment-schedule-response").LoadingOverlay("hide", true);
                            $(".btn-calc-payment-schedule").removeAttr('disabled');
                        }
                    });
            });

            $(".js-schendule").delegate( "tr", "click", function() {
               var term = $(this).find('.js-term-calc').text();
               var amount = $('.js-amount-calc').val();
               var productID = $('.js-product-calc').val();
               $('.js-term').val(term);
               $('.js-amount').val(amount);
               $('.js-product').val(productID);
               $('#modal-calc').modal('hide');
            });
        });
    </script>
@endsection