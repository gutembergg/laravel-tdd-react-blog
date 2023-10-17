import { Post } from '../../../Interfaces/Post';

interface CardContentProps {
    post: Post;
}

function CardContent({ post }: CardContentProps) {
    return (
        <div className="p-5">
            <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{post.title}</h5>

            <p className="mb-3 font-normal text-gray-700 dark:text-gray-400">{post.content.substring(0, 35)}...</p>
        </div>
    );
}

export default CardContent;
