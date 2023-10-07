import { Post } from '../../Interfaces/Post';
import { useApiRequests } from '../../hooks/apiRequest';

interface Props {
    data: Post[] | null;
    error: boolean;
    isLoading: boolean;
}

function LastPosts({ data, error, isLoading }: Props) {
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
