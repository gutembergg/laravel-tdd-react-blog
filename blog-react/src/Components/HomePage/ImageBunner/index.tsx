import imageBunner from '../../../assets/art-blog-home.avif';
import Button from '../../Form/Button';

function ImageBunner() {
    return (
        <div className="relative">
            <img className="object-cover w-full md:max-h-[500px]" src={imageBunner} alt="homepage-image" />

            <div className="md:absolute md:top-[50%] md:left-20">
                <h1 className="text-4xl mt-6 md:mt-0 md:text-6xl text-white font-extrabold outline-20">Art blog websites</h1>
                <Button
                    className="mt-6 py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 
                      focus:outline-none bg-white rounded-lg border border-gray-200
                      hover:bg-gray-100  hover:text-blue-700 focus:z-10 focus:ring-4 
                      focus:ring-gray-200dark:focus:ring-gray-700 dark:bg-gray-800 
                      dark:text-yellow-600 dark:border-gray-600 dark:hover:text-white 
                      dark:hover:bg-gray-700"
                >
                    Créer compte
                </Button>
            </div>
        </div>
    );
}

export default ImageBunner;
