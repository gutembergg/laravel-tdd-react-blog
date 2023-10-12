import { Link } from 'react-router-dom';

function Header() {
    return (
        <nav className="bg-black">
            <div className="flex text-white mx-auto w-full px-2 py-4 sm:px-6 lg:px-8 space-x-6">
                <div className="mr-12">Logo</div>
                <div>
                    <Link to={`posts`}>Tout les articles</Link>
                </div>
                <div>
                    <Link to={`posts`}>Contact</Link>
                </div>
            </div>
        </nav>
    );
}

export default Header;
