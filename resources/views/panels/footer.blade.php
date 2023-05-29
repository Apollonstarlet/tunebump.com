<!-- BEGIN: Footer-->
<footer
  class="page-footer footer-dark gradient-45deg-indigo-purple" style="position: ; bottom: 0; width: 100%;">
  <div class="row" id="musicbar" style="display: none; padding: 1rem 1rem;">
    <div class="col m1 s2">
      <div class="track-art"></div>
    </div>
    <div class="col m3 s10">
      <span id="track-name"></span><br><span id="track-artist" style="font-weight: bold;"></span>
    </div>
    <div class="col m1 s2" style="padding:5px 12px;">
      <div class="playpause-track" onclick="playpauseTrack()"><i class="fa fa-play-circle fa-2x"></i></div>
    </div>
    <div class="col m7 s10" style="display:flex; padding:6px 0;">
      <div class="current-time">00:00</div>
      <input type="range" min="1" max="100" value="0" class="seek_slider" onchange="seekTo()">
      <div class="total-duration">00:00</div>
      <i class="fa fa-volume-down"></i>
      <input type="range" min="1" max="100" value="99" class="volume_slider" onchange="setVolume()">
      <i class="fa fa-volume-up"></i>
    </div>
  </div>
  <div class="row" id="footbar">
      <div class="footer-copyright">
        <div class="container">
          <span class="right hide-on-small-only"> &copy; Tunebump 2022</span>
        </div>
      </div>
  </div>
</footer>
<!-- END: Footer-->