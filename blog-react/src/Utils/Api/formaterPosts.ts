import { Post } from '../../Interfaces/Post';
import PlaceHolderImage from '../../assets/placeholder-image.png';

export const formaterPosts = (posts: Post[] | null): Post[] => {
    if (!posts) {
        return [];
    }

    return posts.map((post) => {
        return formaterPost(post);
    });
};

export const formaterPost = (post: Post) => ({
    id: post.id,
    title: post.title,
    content: post.content,
    categories: post.categories,
    author: post.author,
    slug: post.slug,
    medias: post.medias && post.medias.length > 0 ? post.medias : null,
    created_at: post.created_at ? formaterDate(post.created_at) : '',
});

export const checkHasImage = (post: Post) => {
    if (post.medias) {
        return { path: post.medias[0].path, name: post.medias[0].name };
    }

    return { path: PlaceHolderImage, name: 'placeholder' };
};

const formaterDate = (date: string) => {
    const event = new Date(date);
    const options: any = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return event.toLocaleDateString('fr-Fr', options);
};
