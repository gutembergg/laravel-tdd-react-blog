import { Link } from 'react-router-dom';
import { HTMLAttributes } from 'react';
import { Post } from '../../../Interfaces/Post';
import { Card } from '../Card';
import { checkHasImage, formaterPosts } from '../../../Utils/Api/formaterPosts';

import './styles.css';

interface Props extends HTMLAttributes<HTMLUListElement> {
    data: Post[] | null;
}

function PostsList({ data, ...rest }: Props) {
    const formatedData = formaterPosts(data);

    function readmeMore(post: Post) {
        console.log('readmeMore', post);
    }

    return (
        <>
            {formatedData && (
                <ul {...rest} className={`posts_list gap-4 ${rest.className && rest.className}`}>
                    {formatedData.map((post) => (
                        <li key={post.id}>
                            <Link to={'/post/' + post.slug}>
                                <Card.root>
                                    <Card.image path={checkHasImage(post).path} name={post.title} />
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
