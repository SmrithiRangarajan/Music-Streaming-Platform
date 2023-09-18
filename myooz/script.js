console.log("welcome!");


//initialising wanted variables
let songindex = 0;
let audioElement = new Audio('music/Call it what you want.mp3');
let playbut = document.getElementById('playbutton');
let progressbar = document.getElementById('progressbar');
let songs = [
    {songName: "call it what you want", filePath: "music/Call it what you want.mp3", coverPath: "ts.jpg"},
    {songName: "bad habits", filePath: "music/Bad Habits.mp3", coverPath: "ed.jpg"},
    {songName: "do i wanna know", filePath: "music/Do I Wanna Know.mp3", coverPath: "am.jpg"}
]

//for play/pause
playbut.addEventListener('click', ()=>{
    if(audioElement.paused || audioElement.currentTime<=0){
        audioElement.play();
        playbut.classList.remove('fa-circle-play');
        playbut.classList.add('fa-circle-pause');
    }
    else{
        audioElement.pause();
        playbut.classList.remove('fa-circle-pause');
        playbut.classList.add('fa-circle-play');
    }
})

//event listening
audioElement.addEventListener('timeupdate', ()=>{
    //console.log("timeupdate");
    //updation of seekbar
    progress = parseInt((audioElement.currentTime/audioElement.duration)*100);
    //console.log(progress);
    progressbar.value = progress;
})

progressbar.addEventListener('change', ()=>{
    audioElement.currentTime = progressbar.value * audioElement.duration/100;
})


const makeAllPlays = ()=>{
    Array.from(document.getElementsByClassName('songitemplay')).forEach((element)=>{
        element.classList.add('fa-circle-play');
        element.classList.remove('fa-circle-pause');
    })

}
Array.from(document.getElementsByClassName('songitemplay')).forEach((element)=>{
    element.addEventListener('click', (e)=>{
        console.log(e.target);
        makeAllPlays();
        index = e.target.id;
        //console.log(index);
        e.target.classList.remove('fa-circle-play');
        e.target.classList.add('fa-circle-pause');
        audioElement.src = `music/${index}.mp3`;
        audioElement.currentTime = 0;
        audioElement.play();
        playbut.classList.remove('fa-circle-play');
        playbut.classList.add('fa-circle-pause');
    })
})

//adding to playlist
document.addEventListener('DOMContentLoaded', function() {
    const addToPlaylistButtons = document.querySelectorAll('.addtoplaylist');

    addToPlaylistButtons.forEach(button => {
        button.addEventListener('click', function() {
            const songTitle = this.getAttribute('data-song');
            const playlistId = this.getAttribute('data-playlist-id');
            const buttonId = this.getAttribute('id');

            const xhr = new XMLHttpRequest();
            xhr.open('GET', `add_remove_playlists.php?song=${encodeURIComponent(songTitle)}&playlist=${playlistId}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = xhr.responseText;
                    if (response === 'added') {
                        button.textContent = 'Remove';
                        button.setAttribute('id', `remove_${buttonId.split('_')[2]}`);
                    } else if (response === 'removed') {
                        button.textContent = 'Add to Playlist';
                        button.setAttribute('id', `add_${buttonId.split('_')[1]}`);
                    }
                }
            };
            xhr.send();
        });
    });
});




//addtoplaylist
/*document.addEventListener('DOMContentLoaded', function() {
    const addToPlaylistButtons = document.querySelectorAll('.addtoplaylist');

    addToPlaylistButtons.forEach(button => {
        button.addEventListener('click', function() {
            const songTitle = this.getAttribute('data-song');
            // Now you can perform your AJAX request and toggle button text as needed
            const playlistId = this.getAttribute('data-playlist-id'); 
            

            const xhr = new XMLHttpRequest();
            xhr.open('GET', `add_remove_playlists.php?song=${encodeURIComponent(songTitle)}&playlist=${playlistId}`, true);
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = xhr.responseText;
                if (response === 'added') {
                    button.textContent = 'Remove'; // Change button text
                } else if (response === 'removed') {
                    button.textContent = 'Add to Playlist'; // Change button text
                }
            }
        };
        xhr.send();
        });
    });
});
*/

//add to favourites


document.addEventListener('DOMContentLoaded', function() {
    const heartIcons = document.querySelectorAll('.addtofavourites');

    heartIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const songTitle = this.getAttribute('data-song');
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `add_remove_favorites.php?song=${encodeURIComponent(songTitle)}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = xhr.responseText;
                    if (response === 'added' || response === 'removed') {
                        icon.classList.toggle('fa-solid'); // Toggle the 'fa-solid' class
                        icon.classList.toggle('fa-regular'); // Toggle the 'fa-regular' class
                    }
                }
            };
            xhr.send();
        });
    });
});


//artist info
document.addEventListener('DOMContentLoaded', function() {
    const artistDetails = document.getElementById('artistDetails');
    const artistItems = document.querySelectorAll('.artist-item');

    artistItems.forEach(item => {
        
        item.addEventListener('click', function() {
            const artistId = this.id;

            const xhr = new XMLHttpRequest();
            xhr.open('GET', `artist_details.php?artistId=${artistId}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = xhr.responseText;
                    artistDetails.innerHTML = response;
                }
            };
            xhr.send();
        });
    });
});

//trigger
Array.from(document.getElementsByClassName('songitemplay')).forEach((element) => {
    element.addEventListener('click', (e) => {
        
        const songId = e.target.getAttribute('data-song-id');
        const songTitle = e.target.getAttribute('data-song-title');

        
        const xhrInsertPlayHistory = new XMLHttpRequest();
        xhrInsertPlayHistory.open('GET', `insert_play_history.php?songId=${songId}`, true);
        xhrInsertPlayHistory.onreadystatechange = function() {
            if (xhrInsertPlayHistory.readyState === 4 && xhrInsertPlayHistory.status === 200) {
                //
            }
        };
        xhrInsertPlayHistory.send();

        
    });
});
