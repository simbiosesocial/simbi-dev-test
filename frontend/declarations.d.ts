type Author = {
  id: string;
  name: string;
};

type Book = {
  id: string;
  title: string;
  author: Author;
  coverUrl?: string;
  createdAt: string;
  updatedAt: string;
};
