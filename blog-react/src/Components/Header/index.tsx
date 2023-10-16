import { Link } from 'react-router-dom';

function Header() {
    return (
        <header>
            <nav className="bg-black">
                <div
                    className="flex justify-between w-[90%] text-black dark:text-yellow-600 
                        mx-auto  px-2 py-4 sm:px-6 lg:px-8 
                        space-x-6"
                >
                    <div className="mr-12">Logo</div>
                    <div className="flex gap-4">
                        <Link to="/posts" className="hover:text-white">
                            Tout les articles
                        </Link>

                        <Link to="/" className="hover:text-white">
                            Contact
                        </Link>
                    </div>
                </div>
            </nav>
        </header>
    );
}

export default Header;
