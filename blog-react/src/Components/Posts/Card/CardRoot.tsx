import { ReactNode } from 'react';

interface CardRootProps {
    children: ReactNode;
}

function CardRoot({ children }: CardRootProps) {
    return (
        <div
            className="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800
                 dark:border-gray-700"
        >
            {children}
        </div>
    );
}

export default CardRoot;
