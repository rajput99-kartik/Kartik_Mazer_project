<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Load Activity Details36</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!--<div class="table-responsive">-->
        <!--    <table class="table mb-0" id="carrier_table" >-->
        <!--        <thead class="table-light">-->
        <!--            <tr>-->
        <!--                <th>Load No</th>-->
        <!--                <th>Carrier Rate</th>-->
        <!--                <th>Quickpay Amount</th>-->
        <!--                <th>Carrier Total</th>-->
        <!--                <th>Customer Total</th>-->
        <!--            </tr>-->
        <!--        </thead>-->
        <!--        <tbody>-->
        <!--            <tr>-->
        <!--                <td>{{$LoadActivity->shipment_id_load}}</td>-->
        <!--                <td>{{$LoadActivity->carrier_rate_dropdown}}</td>-->
        <!--                <td>{{$LoadActivity->quickpay_amount}}</td>-->
        <!--                <td>{{$LoadActivity->carrier_total}}</td>-->
        <!--                <td>{{$LoadActivity->customer_total}}</td>-->
        <!--            </tr>-->
        <!--        </tbody>-->
        <!--    </table>-->
        <!--</div>-->
        <div class="load-acti-data">
            <div class="data-box">
                <b>Carrier Rate</b>
                <p>{{$LoadActivity->carrier_rate_dropdown}}</p>
            </div>
            <div class="data-box">
                <b>Rate Unit 1</b>
                <p>{{$LoadActivity->rate_unit1_carrier}}</p>
            </div>
            <div class="data-box">
                <b>Rate Unit 2</b>
                <p>{{$LoadActivity->rate_unit2_carrier}}</p>
            </div>
            <div class="data-box">
                <b>lh_customer</b>
                <p>{{$LoadActivity->lh_customer}}</p>
            </div>
            <div class="data-box">
                <b>lh_carrier	</b>
                <p>{{$LoadActivity->lh_carrier	}}</p>
            </div>
            <div class="data-box">
                <b>transportation1</b>
                <p>{{$LoadActivity->transportation1}}</p>
            </div>
            <div class="data-box">
                <b>line_haul1</b>
                <p>{{$LoadActivity->line_haul1}}</p>
            </div>
            <div class="data-box">
                <b>carrier1</b>
                <p>{{$LoadActivity->carrier1}}</p>
            </div>
            <div class="data-box">
                <b>customer1</b>
                <p>{{$LoadActivity->customer1}}</p>
            </div>
            <div class="data-box">
                <b>transportation2</b>
                <p>{{$LoadActivity->transportation2}}</p>
            </div>
            <div class="data-box">
                <b>line_haul2</b>
                <p>{{$LoadActivity->line_haul2}}</p>
            </div>
            <div class="data-box">
                <b>carrier2</b>
                <p>{{$LoadActivity->carrier2}}</p>
            </div>
            <div class="data-box">
                <b>customer2</b>
                <p>{{$LoadActivity->customer2}}</p>
            </div>
            <div class="data-box">
                <b>transportation3</b>
                <p>{{$LoadActivity->transportation3}}</p>
            </div>
            <div class="data-box">
                <b>line_haul3</b>
                <p>{{$LoadActivity->line_haul3}}</p>
            </div>
            <div class="data-box">
                <b>carrier3</b>
                <p>{{$LoadActivity->carrier3}}</p>
            </div>
            <div class="data-box">
                <b>customer3</b>
                <p>{{$LoadActivity->customer3}}</p>
            </div>
            <div class="data-box">
                <b>transportation4</b>
                <p>{{$LoadActivity->transportation4}}</p>
            </div>
            <div class="data-box">
                <b>line_haul4</b>
                <p>{{$LoadActivity->line_haul4}}</p>
            </div>
            <div class="data-box">
                <b>carrier4</b>
                <p>{{$LoadActivity->carrier4}}</p>
            </div>
            <div class="data-box">
                <b>customer4</b>
                <p>{{$LoadActivity->customer4}}</p>
            </div>
            <div class="data-box">
                <b>transportation5</b>
                <p>{{$LoadActivity->transportation5}}</p>
            </div>
            <div class="data-box">
                <b>line_haul5</b>
                <p>{{$LoadActivity->line_haul5}}</p>
            </div>
            <div class="data-box">
                <b>carrier5</b>
                <p>{{$LoadActivity->carrier5}}</p>
            </div>
            <div class="data-box">
                <b>customer5</b>
                <p>{{$LoadActivity->customer5}}</p>
            </div>
            <div class="data-box">
                <b>transportation6</b>
                <p>{{$LoadActivity->transportation6}}</p>
            </div>
            <div class="data-box">
                <b>line_haul6</b>
                <p>{{$LoadActivity->line_haul6}}</p>
            </div>
            <div class="data-box">
                <b>carrier6</b>
                <p>{{$LoadActivity->carrier6}}</p>
            </div>
            <div class="data-box">
                <b>customer6</b>
                <p>{{$LoadActivity->customer6}}</p>
            </div>
            <div class="data-box">
                <b>quickpay_deduction</b>
                <p>{{$LoadActivity->quickpay_deduction}}</p>
            </div>
            <div class="data-box">
                <b>quickpay_amount</b>
                <p>{{$LoadActivity->quickpay_amount}}</p>
            </div>
            <div class="data-box">
                <b>carrier_total</b>
                <p>{{$LoadActivity->carrier_total}}</p>
            </div>
            <div class="data-box">
                <b>customer_total</b>
                <p>{{$LoadActivity->customer_total}}</p>
            </div>
            <div class="data-box">
                <b>shipment_id_load</b>
                <p>{{$LoadActivity->shipment_id_load}}</p>
            </div>
            <div class="data-box">
                <b>p_name</b>
                <p>{{$LoadActivity->p_name}}</p>
            </div>
            <div class="data-box">
                <b>p_address</b>
                <p>{{$LoadActivity->p_address}}</p>
            </div>
            <div class="data-box">
                <b>City</b>
                <p>{{$LoadActivity->p_city}}</p>
            </div>
            <div class="data-box">
                <b>State</b>
                <p>{{$LoadActivity->p_state}}</p>
            </div>
            <div class="data-box">
                <b>Zip</b>
                <p>{{$LoadActivity->p_zip}}</p>
            </div>
            <div class="data-box">
                <b>Ref</b>
                <p>{{$LoadActivity->p_ref}}</p>
            </div>
            <div class="data-box">
                <b>Contact</b>
                <p>{{$LoadActivity->p_contact}}</p>
            </div>
            <div class="data-box">
                <b>Phone</b>
                <p>{{$LoadActivity->p_phone}}</p>
            </div>
            <div class="data-box">
                <b>Email</b>
                <p>{{$LoadActivity->p_email}}</p>
            </div>
            <div class="data-box">
                <b>Ready</b>
                <p>{{$LoadActivity->p_ready}}</p>
            </div>
            <div class="data-box">
                <b>Rtime</b>
                <p>{{$LoadActivity->p_rtime}}</p>
            </div>
            <div class="data-box">
                <b>Appt Note</b>
                <p>{{$LoadActivity->p_appt_note}}</p>
            </div>
            <div class="data-box">
                <b>Name</b>
                <p>{{$LoadActivity->d_name}}</p>
            </div>
            <div class="data-box">
                <b>Address</b>
                <p>{{$LoadActivity->d_address}}</p>
            </div>
            <div class="data-box">
                <b>City</b>
                <p>{{$LoadActivity->d_city}}</p>
            </div>
            <div class="data-box">
                <b>State</b>
                <p>{{$LoadActivity->d_state}}</p>
            </div>
            <div class="data-box">
                <b>Zip</b>
                <p>{{$LoadActivity->d_zip}}</p>
            </div>
            <div class="data-box">
                <b>Ref</b>
                <p>{{$LoadActivity->d_ref}}</p>
            </div>
            <div class="data-box">
                <b>Contact</b>
                <p>{{$LoadActivity->d_contact}}</p>
            </div>
            <div class="data-box">
                <b>Phone</b>
                <p>{{$LoadActivity->d_phone}}</p>
            </div>
            <div class="data-box">
                <b>Email</b>
                <p>{{$LoadActivity->d_email}}</p>
            </div>
            <div class="data-box">
                <b>Ready</b>
                <p>{{$LoadActivity->d_ready}}</p>
            </div>
            <div class="data-box">
                <b>Rtime</b>
                <p>{{$LoadActivity->d_rtime}}</p>
            </div>
            <div class="data-box">
                <b>Appt Aote</b>
                <p>{{$LoadActivity->d_appt_note}}</p>
            </div>
        </div>
      </div>
    </div>
</div>