import ImageBunner from '../../Components/HomePage/ImageBunner';
import PostsList from '../../Components/Posts/PostsList/PostsList';
import Error from '../../Components/Utils/Error';
import Loading from '../../Components/Utils/Loading';
import { useApiRequests } from '../../hooks/useApiRequest';
import { Post } from '../../Interfaces/Post';
import DefaultLayout from '../../layouts/DefaultLayout';

import './styles.css';

function HomePage() {
    const { data, error, isLoading } = useApiRequests<Post[]>('http://localhost/api/posts/');

    return (
        <DefaultLayout>
            <div className="flex flex-col bg-inherit">
                <ImageBunner />
                <div className="content w-[90%] mx-auto">
                    <h1
                        id="post-list_title"
                        className="text-4xl text-yellow-600 text-center 
                        font-semibold py-12"
                    >
                        Derniers articles
                    </h1>

                    {error && <Error />}

                    {isLoading && <Loading />}

                    {data && (
                        <div>
                            <PostsList className="posts-list_animate" data={data} />
                        </div>
                    )}
                </div>

                <footer>Footer</footer>
            </div>
        </DefaultLayout>
    );
}

export default HomePage;
