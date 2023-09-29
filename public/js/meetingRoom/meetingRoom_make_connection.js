var peer_first = peer_connection(MY_UNIQUE_ID);


function peer_connection(unique_id) {
    var peer = new Peer(unique_id,{
        host: '/',
        port: '3002',
    })
    const dataConnection = peer.connect(MY_UNIQUE_ID,{
        userName:USER_NAME,
        hashtag:USER_HAHSTAG,
        user_id:USER_ID
    })
    console.log(dataConnection);
}