<footer class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow">
  <div class="footer-copyright">
    <div class="container"><span>&copy; {{date('Y')}}&nbsp @if (!empty($setting->footer_text))
    	{{__($setting->footer_text)}} @else {{__('All rights reserved.')}}
    @endif</span></div>
  </div>
</footer>