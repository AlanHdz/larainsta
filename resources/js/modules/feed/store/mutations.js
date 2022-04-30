export const getPosts = (state, { posts }) => {
    state.posts = posts
}

export const removePost = (state, postId) => {

    let index = state.posts.findIndex((p) => {
        p.id === postId;
    });
    state.posts.splice(index, 1);
    

}
