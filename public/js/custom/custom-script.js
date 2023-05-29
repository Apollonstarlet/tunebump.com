(function($) {
    
    var spotifyId = localStorage.getItem('spotifyId');
    let link = $('a#Playlist').href;
    console.log('link: ' + link);
    link += '/' + spotifyId;
    console.log('link: ' + link);
    $('a#Playlist').attr('href', link);
    
})(window.jQuery);