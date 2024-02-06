console.log(game_likes);

jQuery(document).ready(function($) {

    $('.likes').on('click', function(e){
        e.preventDefault();

        let post_id = $(this).data('game-id');

        if( ! post_id ) return;

        const target = $(this);
        let likes_elm = $(this).find('[data-likes]').get(0);

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: game_likes.ajax_url,
            data: {
                action:'add_game_like',
                post_id,
            },
            success: function(data){

                if (!data.likes) return;

                //Update the likes on the page
                $(likes_elm).attr('data-likes', data.likes);
                $(likes_elm).text(data.likes);

                // Switch the heart icon
                $(target).find('.fa-heart').toggleClass('fa-regular fa-solid')

            }
        });
    });
});