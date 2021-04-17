<link rel="stylesheet" href="{{ asset('/assets/css/jquery.seat-charts.css') }}">


<div class="seat-container">
    <div id="seat-map">
        <div class="front-indicator">Front</div>
    </div>
    <div class="booking-details">
        <h2>Booking Details</h2>
        <h3> Selected Seats (<span id="counter">0</span>):</h3> <br>
        <ul id="selected-seats">
        </ul>
        Total: <b>Rs. <span id="total">0</span></b> <br><br>
        <form method="POST" onsubmit="return checkSeatEmpty();" action="{{ url('checkout') }}">
            @csrf
            <input type="hidden" id="selected_seats_id" name="selected_seats_id">
            <input type="hidden" id="selected_seats_num" name="selected_seats_num">
            <input type="hidden" id="booked_date" name="booked_date">
            <input type="hidden" id="total_price" name="total_price">
            <input type="hidden" name="bus" value="{{$bus->id}}">
            <input type="submit" class="btn-sm btn-outline-green" value="Checkout">
        </form>
        <div id="legend"></div>
    </div>
</div>
<?php

$arr=[];
//echo ( $unav_seat->booked_seats_id ?? '' );
if(empty($unav_seat)){
//    echo "<p>Data does not exist</p>";
}else{
    $arr = explode(',', $unav_seat->booked_seats_id);
    //print_r($arr);
    }
?>
<script src="{{ asset('/assets/js/jquery.seat-charts.min.js') }}"></script>

<script>
    var selected_seats_id = [];
    var selected_seats_num = [];

    seatLayout();


    function seatLayout() {

        var firstSeatLabel = 1;
        $total_price = 0;

        var seat_35 = [
            '___aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aaaaa',
        ];

        var seat_39 = [
            '___aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aaaaa',
        ];

        var seat_43 = [
            '___aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aaaaa',
        ];

        var seat_47 = [
            '___aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aa_aa',
            'aaaaa',
        ];

        var $cart = $('#selected-seats'),
            $counter = $('#counter'),
            $total = $('#total'),
            sc = $('#seat-map').seatCharts({
                map: seat_{{$bus->seat_num}},
                seats: {
                    a: {
                        price: {{$bus->price}},
                        classes: 'available-class', //your custom CSS class
                        category: 'Available Seats'
                    }

                },
                naming: {
                    top: false,
                    getLabel: function (character, row, column) {
                        return firstSeatLabel++;
                    },
                },
                legend: {
                    node: $('#legend'),
                    items: [
                        ['a', 'available', 'Available Seats'],
                        ['u', 'unavailable', 'Already Booked'],
                        ['s', 'selected', 'Selected Seats']
                    ]
                },
                click: function () {
                    if (this.status() == 'available') {
                        //let's create a new <li> which we'll add to the cart items
                        $('<li>' + ' Seat # ' + this.settings.label + ': <b>Rs. ' + this.data().price + '</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
                            .attr('id', 'cart-item-' + this.settings.id)
                            .data('seatId', this.settings.id)
                            .appendTo($cart);
                        /*
                         * Lets update the counter and total
                         *
                         * .find function will not find the current seat, because it will change its stauts only after return
                         * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
                         */
                        $counter.text(sc.find('selected').length + 1);
                        $total.text(recalculateTotal(sc) + this.data().price);
                        total_price = $total.text();
                        selected_seats_id.push(this.settings.id);
                        selected_seats_num.push(this.settings.label);

                        return 'selected';

                    } else if (this.status() == 'selected') {

                        //update the counter
                        $counter.text(sc.find('selected').length - 1);
                        //and total
                        $total.text(recalculateTotal(sc) - this.data().price);

                        //remove the item from our cart
                        $('#cart-item-' + this.settings.id).remove();

                        //seat has been vacated

                        selected_seats_id.splice(selected_seats_id.indexOf(this.settings.id), 1);
                        selected_seats_num.splice(selected_seats_num.indexOf(this.settings.label), 1);
                        return 'available';


                    } else if (this.status() == 'unavailable') {
                        //seat has been already booked
                        return 'unavailable';
                    } else {
                        return this.style();
                    }
                }

            });

        //this will handle "[cancel]" link clicks
        $('#selected-seats').on('click', '.cancel-cart-item', function () {
            //let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
            sc.get($(this).parents('li:first').data('seatId')).click();
        });

        //let's pretend some seats have already been booked


        var unav_seat = <?php echo json_encode($arr); ?>;

       // alert(unav_seat);
        $(unav_seat).each(function(entry, value) {
            unav_seat[entry] = value.replace(/\s+/g, '');
            console.log(unav_seat[entry]);
        });
        // var unav_seat = ['1_5', '4_1', '7_1', '7_2'];
        // alert(unav_seat);
        sc.get(unav_seat).status('unavailable');


        function recalculateTotal(sc) {
            var total = 0;

            //basically find every selected seat and sum its price
            sc.find('selected').each(function () {
                total += this.data().price;
            });
            return total;
        }
    }


    function checkSeatEmpty() {
        if (selected_seats_id.length == 0) {
            alert("Please select atleast one seat");
            return false;

        } else {
            var sorted_seat_num = selected_seats_num.sort(function (a, b) {
                return a - b
            });
            var sorted_seat_id = selected_seats_id.sort(function (a, b) {
                return a - b
            });

            $('#selected_seats_id').val(sorted_seat_id.join(', '));
            $('#selected_seats_num').val(sorted_seat_num.join(', '));
            $('#booked_date').val(travel_date);
            $('#total_price').val(total_price);
            return true;
        }

    }
</script>
