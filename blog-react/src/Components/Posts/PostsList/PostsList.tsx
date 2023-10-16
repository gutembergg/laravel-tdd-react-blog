import { HTMLAttributes } from 'react';
import { Post } from '../../../Interfaces/Post';
import PlaceHolderImage from '../../../assets/placeholder-image.png';

import './styles.css';
import { Link } from 'react-router-dom';

interface Props extends HTMLAttributes<HTMLUListElement> {
    data: Post[] | null;
    error: boolean;
    isLoading: boolean;
    className: string;
}

function PostsList({ data, error, isLoading, className, ...rest }: Props) {
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

    return (
        <>
            {data && (
                <ul {...rest} className={`posts_list gap-4 ${className}`}>
                    {data.map((post) => (
                        <li key={post.id}>
                            <Link to={`post/${post.slug}`}>
                                <div className="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <a href="#">
                                        <img className="w-full min-h-[300px] rounded-t-lg object-cover" src={checkHasImage(post)} alt={post.title} />
                                    </a>

                                    <div className="p-5">
                                        <a href="#">
                                            <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{post.title}</h5>
                                        </a>
                                        <p className="mb-3 font-normal text-gray-700 dark:text-gray-400">{post.content.substring(0, 35)}...</p>
                                        <a
                                            href="#"
                                            className="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            Read more
                                        </a>
                                    </div>
                                </div>
                            </Link>
                        </li>
                    ))}
                </ul>
            )}
        </>
    );
}

export default PostsList;
