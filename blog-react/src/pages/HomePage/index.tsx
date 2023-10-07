import { Link } from 'react-router-dom';
import LastPosts from '../../Components/Posts/LastPosts';
import { Post } from '../../Interfaces/Post';
import { useApiRequests } from '../../hooks/apiRequest';

function HomePage() {
    const { data, error, isLoading } = useApiRequests<Post[]>('http://localhost/api/posts/');

    return (
        <div>
            <header>
                <div>
                    <Link to={`posts`}>Parcourir tout les articles</Link>
                </div>
            </header>

            <div className="main">
                <LastPosts data={data} error={error} isLoading={isLoading} />
            </div>

            <footer>Footer</footer>
        </div>
    );
}

export default HomePage;
