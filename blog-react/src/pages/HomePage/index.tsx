import { Link } from 'react-router-dom';
import LastPosts from '../../Components/Posts/LastPosts';

function HomePage() {
    return (
        <div>
            <header>
                <div>
                    <Link to={`posts`}>Parcourir tout les articles</Link>
                </div>
            </header>

            <div className="main">
                <LastPosts />
            </div>

            <footer>Footer</footer>
        </div>
    );
}

export default HomePage;
