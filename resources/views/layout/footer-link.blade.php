    </body>
    <b id="error_title" data-value="{{__('label.Error!')}}"></b>
    <b id="success_title" data-value="{{__('label.Success!')}}"></b>
    <b id="info_title" data-value="{{__('label.Attention!')}}"></b>
    
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/global.js') }}" type="text/javascript"></script>
    @stack('script')
</html>
