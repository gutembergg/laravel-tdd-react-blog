import { Post } from '../../Interfaces/Post';
import { useApiRequests } from '../../hooks/apiRequest';

function LastPosts() {
    const { data, error, isLoading } = useApiRequests<Post[]>('http://localhost/api/posts/');

    return (
        <div>
            {isLoading && <div className="loading">Loading...</div>}
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
