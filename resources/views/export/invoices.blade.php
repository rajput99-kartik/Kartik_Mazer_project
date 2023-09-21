<table>
    <thead>
    <tr>
        <th>user_id <th>load_dat_id<th>alarm_status<th>alarm_id <th>search_id<th>age<th>ref_no<th>load_status<th>load_status_two<th>agent_name
            <th>comment<th>shipper_price<th>load_carrier_price<th>load_rate_range_from <th>load_rate_range_to<th>distance<th>post_date<th>pick_up_date<th>delivery_date<th>dat_pick_date
            <th>dat_drop_date<th>load_state_origin<th>load_state_origin_id<th>load_zipcode_origin <th>load_state_code<th>load_city_desti_id<th>load_city_desti<th>drop_state_code<th>load_offer_rate<th>load_rate_base_on
            <th>pallets<th>load_hight_inches<th>length_load<th>o_lat <th>o_long<th>d_lat<th>d_long<th>equipments<th>equipment_spotrates<th>full_partial_tl_ltl
            <th>load_commodity<th>weight_load<th>special_requirement<th>p_u_hours_comment <th>p_u_hours<th>load_generate
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->user_id}}</td>
            <td>{{ $invoice->load_dat_id}}</td>
            <td>{{ $invoice->alarm_status}}</td>
            <td>{{ $invoice->alarm_id}}</td>
            <td>{{ $invoice->search_id}}</td>
            <td>{{ $invoice->age}}</td>
            <td>{{ $invoice->ref_no}}</td>
            <td>{{ $invoice->load_status}}</td>
            <td>{{ $invoice->load_status_two}}</td>
            <td>{{ $invoice->agent_name}}</td>
            <td>{{ $invoice->comment}}</td>
            <td>{{ $invoice->shipper_price}}</td>
            <td>{{ $invoice->load_carrier_price}}</td>
            <td>{{ $invoice->load_rate_range_from}}</td>
            <td>{{ $invoice->load_rate_range_to}}</td>
            <td>{{ $invoice->distance}}</td>
            <td>{{ $invoice->post_date}}</td>
            <td>{{ $invoice->pick_up_date}}</td>
            <td>{{ $invoice->delivery_date}}</td>
            <td>{{ $invoice->dat_pick_date}}</td>
            <td>{{ $invoice->dat_drop_date}}</td>
            <td>{{ $invoice->load_state_origin}}</td>
            <td>{{ $invoice->load_state_origin_id}}</td>
            <td>{{ $invoice->load_zipcode_origin}}</td> 
            <td>{{ $invoice->load_state_code}}</td>
            <td>{{ $invoice->load_city_desti_id}}</td>
            <td>{{ $invoice->load_city_desti}}</td>
            <td>{{ $invoice->drop_state_code}}</td>
            <td>{{ $invoice->load_offer_rate}}</td>
            <td>{{ $invoice->load_rate_base_on}}</td>
            <td>{{ $invoice->pallets}}</td>
            <td>{{ $invoice->load_hight_inches}}</td>
            <td>{{ $invoice->length_load}}</td>
            <td>{{ $invoice->o_lat}}</td>
            <td>{{ $invoice->o_long}}</td>
            <td>{{ $invoice->d_lat}}</td>
            <td>{{ $invoice->d_long}}</td>
            <td>{{ $invoice->equipments}}</td>
            <td>{{ $invoice->equipment_spotrates}}</td>
            <td>{{ $invoice->full_partial_tl_ltl}}</td>
            <td>{{ $invoice->load_commodity}}</td>
            <td>{{ $invoice->weight_load}}</td>
            <td>{{ $invoice->special_requirement}}</td>
            <td>{{ $invoice->p_u_hours_comment}}</td>
            <td>{{ $invoice->p_u_hours}}</td>
            <td>{{ $invoice->load_generate }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>


