import { PrimaryGeneratedColumn, Column, Entity } from 'typeorm';

@Entity()
class Room {
  @PrimaryGeneratedColumn()
  public Id!: number;
  @Column()
  public Name: string;
}

export default Room;
