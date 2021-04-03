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
        <button class="btn-sm btn-outline-green">Checkout &raquo;</button>
        <br>
        <div id="legend"></div>
    </div>
</div>

<script src="{{ asset('/assets/js/jquery.seat-charts.min.js') }}"></script>

<script>


    seatLayout({{$bus->seat_num}}, {{$bus->price}});


    function seatLayout(bus_seat_no, bus_price) {

        var firstSeatLabel = 1;
        var price = bus_price;
        var bus_seat_no = bus_seat_no;

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

        var $cart = $('#selected-seats'),
            $counter = $('#counter'),
            $total = $('#total'),
            sc = $('#seat-map').seatCharts({
                map: seat_35,
                seats: {
                    a: {
                        price: bus_price,
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

                        return 'selected';
                    } else if (this.status() == 'selected') {
                        //update the counter
                        $counter.text(sc.find('selected').length - 1);
                        //and total
                        $total.text(recalculateTotal(sc) - this.data().price);

                        //remove the item from our cart
                        $('#cart-item-' + this.settings.id).remove();

                        //seat has been vacated
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
        var unav_seat = ['1_5', '4_1', '7_1', '7_2'];
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


</script>
</body>
</html>
