import { Media, Post, PostView } from '../../Interfaces/Post';
import imageBunner from '../../assets/placeholder-image.png';

export const formatApiResponseArray = (posts: Post[] | null): PostView[] => {
    if (!posts) {
        return [];
    }

    return posts.map((post) => ({
        id: post.id,
        title: post.title,
        content: post.content,
        categories: post.categories,
        author: post.author,
        slug: post.slug,
        mediaPath: post.medias && post.medias?.length > 0 ? post.medias[0].path : imageBunner,
    }));
};
