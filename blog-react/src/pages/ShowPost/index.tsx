import { useParams } from 'react-router-dom';
import { Show } from '../../Components/Posts/Show';
import { useApiRequests } from '../../hooks/useApiRequest';
import DefaultLayout from '../../layouts/DefaultLayout';
import { Post } from '../../Interfaces/Post';

function ShowPost() {
    const { slug } = useParams();

    const { data } = useApiRequests<Post>(`http://localhost/api/posts/show/${slug}`);

    console.log('Data', data ? data.medias : null);

    return (
        <DefaultLayout>
            {/*   <div className="flex flex-col justify-center items-center py-12">
                <img src={data?.medias ? data.medias[0].path : ''} alt="" />
            </div> */}
            <Show.Root>
                <Show.Image path={data?.medias ? data.medias[0].path : ''} />
            </Show.Root>
        </DefaultLayout>
    );
}

export default ShowPost;
