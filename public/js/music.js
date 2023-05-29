let musicbar = document.querySelector("#musicbar");
let footbar = document.querySelector("#footbar");
let now_playing = document.querySelector(".now-playing");
let track_art = document.querySelector(".track-art");
let track_name = document.querySelector("#track-name");
let track_artist = document.querySelector("#track-artist");
let playpause_btn = document.querySelector(".playpause-track");
let seek_slider = document.querySelector(".seek_slider");
let volume_slider = document.querySelector(".volume_slider");
let curr_time = document.querySelector(".current-time");
let total_duration = document.querySelector(".total-duration");

// let track_index = 0;
let isPlaying = false;
let updateTimer;

// Create new audio element
let curr_track = document.createElement('audio');
let id = 'cc';
let cid;

function playFunction(e) {
  musicbar.style.display = '';
  footbar.style.display = 'none';
  var music_data = e.split('--');
  if(id != 'cc'+ music_data[4]){
    if(id != 'cc'){
      document.getElementById(id).setAttribute("style", "");
      cid = 'ccc'+ music_data[4];
      document.getElementById(cid).setAttribute("style", "");
    }
    id = 'cc'+ music_data[4];
    cid = 'c'+ id;
    clearInterval(updateTimer);
    resetValues();
    curr_track.src = music_data[2];
    curr_track.load();
    track_art.style.backgroundImage = "url(" + music_data[1] + ")";
    track_name.textContent = music_data[0];
    track_artist.textContent = 'By '+ music_data[3];
    updateTimer = setInterval(seekUpdate, 1000);
    isPlaying = false;
  }
  playpauseTrack();
}

function resetValues() {
  curr_time.textContent = "00:00";
  total_duration.textContent = "00:00";
  seek_slider.value = 0;
}

function playpauseTrack() {
  if (!isPlaying) playTrack();
  else pauseTrack();
}

function playTrack() {
  document.getElementById(id).setAttribute("style", "background-image:url('/images/pause.png');");
  document.getElementById(cid).setAttribute("style", "background-image:url('/images/pause.png');");
  curr_track.play();
  isPlaying = true;
  playpause_btn.innerHTML = '<i class="fa fa-pause-circle fa-2x"></i>';
}

function pauseTrack() {
  document.getElementById(id).setAttribute("style", "");
  document.getElementById(cid).setAttribute("style", "");
  curr_track.pause();
  isPlaying = false;
  playpause_btn.innerHTML = '<i class="fa fa-play-circle fa-2x"></i>';
}

function seekTo() {
  let seekto = curr_track.duration * (seek_slider.value / 100);
  curr_track.currentTime = seekto;
}

function setVolume() {
  curr_track.volume = volume_slider.value / 100;
}

function seekUpdate() {
  let seekPosition = 0;

  if (!isNaN(curr_track.duration)) {
    seekPosition = curr_track.currentTime * (100 / curr_track.duration);

    seek_slider.value = seekPosition;

    let currentMinutes = Math.floor(curr_track.currentTime / 60);
    let currentSeconds = Math.floor(curr_track.currentTime - currentMinutes * 60);
    let durationMinutes = Math.floor(curr_track.duration / 60);
    let durationSeconds = Math.floor(curr_track.duration - durationMinutes * 60);

    if (currentSeconds < 10) { currentSeconds = "0" + currentSeconds; }
    if (durationSeconds < 10) { durationSeconds = "0" + durationSeconds; }
    if (currentMinutes < 10) { currentMinutes = "0" + currentMinutes; }
    if (durationMinutes < 10) { durationMinutes = "0" + durationMinutes; }

    curr_time.textContent = currentMinutes + ":" + currentSeconds;
    total_duration.textContent = durationMinutes + ":" + durationSeconds;
  }
}