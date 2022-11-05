<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright 2022 <strong><span>Tom's World Philippines</span></strong>. All Rights Reserved
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/chart.js/chart.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/echarts/echarts.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/quill/quill.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<script>
    function startTime() {
        var today = new Date();
        var hr = today.getHours();
        var min = today.getMinutes();
        var sec = today.getSeconds();
        ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
        hr = (hr == 0) ? 12 : hr;
        hr = (hr > 12) ? hr - 12 : hr;
        //Add a zero in front of numbers<10
        hr = checkTime(hr);
        min = checkTime(min);
        sec = checkTime(sec);
        document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;

        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        var curWeekDay = days[today.getDay()];
        var curDay = today.getDate();
        var curMonth = months[today.getMonth()];
        var curYear = today.getFullYear();
        var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear;
        document.getElementById("date").innerHTML = date;

        var time = setTimeout(function() {
            startTime()
        }, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
</script>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({

            displayEventTime: false,
            timeFormat: 'H(:mm)',

            // header: {
            //     left: 'prev,next today',
            //     center: 'title',
            //     right: 'month,agendaWeek,agendaDay'
            // },

            allDayDefault: false,
            editable: true,
            droppable: true,
            height: 530,

            // eventRender: function(event, el) {
            //     // el.find('.fc-content').html("<i class='fa fa-camera-retro fa-3x'></i>");
            // },
            // events: [{
            //     title: 'event1',
            //     start: '2022-09-01 06:44:00'
            // }, {
            //     title: 'event2',
            //     start: '2022-09-05 06:50:00',
            // }, {
            //     title: 'event3',
            //     start: '2017-02-01 10:50:00',
            // }, {
            //     title: 'event3',
            //     start: '2017-02-01 12:50:00',
            // }, {
            //     title: 'event3',
            //     start: '2017-02-01 13:50:00',
            // }, ]
        });

    });
</script>

<script>
    $(document).ready(function() {

        function load_unseen_notification(view = '') {
            $.ajax({
                url: "<?= base_url() . 'Notifications/getNotif' ?>",
                method: "POST",
                data: {
                    view: view
                },
                dataType: "json",
                success: function(data) {
                    $('#notifications').html(data.notification);

                    if (data.unseen_notification > 0) {
                        $('.count').html(data.unseen_notification);
                        $('.count-notif').html(data.unseen_notification)
                    } else {
                        $('.hide-notif').html('')
                    }
                }
            });
        }

        load_unseen_notification();

        setInterval(function() {
            load_unseen_notification();;
        }, 1000);
    });
</script>

</body>

</html>