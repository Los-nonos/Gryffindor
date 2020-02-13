import User from '../Entities/User';

export default interface IUserRepository {
	FindById(id: number): Promise<User>;
	Find(params: any): Promise<User[]>;
	Persist(t: User): Promise<User>;
	Update(t: User): Promise<void>;
	Delete(t: User): Promise<void>;
}
