import { Link } from 'react-router-dom';
import { HTMLAttributes } from 'react';
import PlaceHolderImage from '../../../assets/placeholder-image.png';
import { Post, PostView } from '../../../Interfaces/Post';
import { Card } from '../Card';

import './styles.css';

interface Props extends HTMLAttributes<HTMLUListElement> {
    data: PostView[] | null;
    error: boolean;
    isLoading: boolean;
}

function PostsList({ data, error, isLoading, ...rest }: Props) {
    if (isLoading) {
        return <div data-testid="loading">Loading...</div>;
    }

    if (error) {
        return <div data-testid="error">Error...</div>;
    }

    function checkHasImage(post: Post) {
        if (post.medias && post.medias.length > 0) {
            return post.medias[0].path;
        }

        return PlaceHolderImage;
    }

    function readmeMore(post: PostView) {
        console.log('readmeMore', post);
    }

    return (
        <>
            {data && (
                <ul {...rest} className={`posts_list gap-4 ${rest.className}`}>
                    {data.map((post) => (
                        <li key={post.id}>
                            <Link to={`post/${post.slug}`}>
                                <Card.root>
                                    <Card.image path={post.mediaPath} name={post.title} />
                                    <Card.content post={post} />
                                    <Card.action onClick={() => readmeMore(post)} />
                                </Card.root>
                            </Link>
                        </li>
                    ))}
                </ul>
            )}
        </>
    );
}

export default PostsList;
