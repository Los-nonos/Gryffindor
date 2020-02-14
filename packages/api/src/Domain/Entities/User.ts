import { PrimaryGeneratedColumn, Column, Entity } from 'typeorm';
import * as bcrypt from 'bcrypt';

@Entity()
class User {
  @PrimaryGeneratedColumn()
  public Id!: number;
  @Column()
  public Name: string;
  @Column()
  public Email: string;
  @Column()
  public Phone: string;
  @Column()
  public Password: string;

  public hashPassword(unHashPassword: string) {
    this.Password = bcrypt.hashSync(unHashPassword, 8);
  }
}

export default User;
