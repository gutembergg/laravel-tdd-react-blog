import { ButtonHTMLAttributes } from 'react';

interface CardActionButtonProps extends ButtonHTMLAttributes<HTMLButtonElement> {
    name?: string;
}

function CardAction({ name, ...rest }: CardActionButtonProps) {
    return (
        <div className="px-5 pb-3">
            <button
                {...rest}
                className="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                {name ?? 'Read more'}
            </button>
        </div>
    );
}

export default CardAction;
