import { Link } from 'react-router-dom';

function HeaderLinks() {
    return (
        <div className="flex gap-4">
            <Link to="/posts" className="hover:text-white">
                Tout les articles
            </Link>

            <Link to="/" className="hover:text-white">
                Contact
            </Link>
        </div>
    );
}

export default HeaderLinks;
