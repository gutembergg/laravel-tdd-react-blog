import { Post } from '../../Interfaces/Post';
import { useApiRequests } from '../../hooks/useApiRequest';

function LastPosts() {
    const { data, error, isLoading } = useApiRequests<Post[]>('http://localhost/api/posts/');

    if (isLoading) {
        return <div className="loading">Loading...</div>;
    }

    return (
        <div>
            {data && (
                <ul>
                    {data.map((post) => (
                        <li key={post.id}>{post.title}</li>
                    ))}
                </ul>
            )}
        </div>
    );
}

export default LastPosts;
